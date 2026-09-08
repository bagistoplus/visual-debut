import { defineComponent, setup } from 'alpine-define-component';

interface Props {
  uploadUrl?: string;
  searchUrl?: string;
  messages?: {
    invalidFileType?: string;
    fileTooLarge?: string;
    uploadFailed?: string;
    analysisFailed?: string;
    libraryLoadFailed?: string;
  };
}

/**
 * Bagisto's upload endpoint changed shape in 2.4.8. Earlier versions answer with
 * the image URL as a plain string, 2.4.8+ answers with this object. `engine` is
 * `ai` when Magic AI already classified the image server side, `tensorflow`
 * when the classification is left to the browser.
 */
interface UploadResponse {
  image_url?: string;
  keywords?: string;
  engine?: string;
}

// Constants
const MAX_IMAGE_SIZE = 2 * 1024 * 1024;
const LIBRARIES = {
  tensorflow: 'https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js',
  mobilenet: 'https://cdn.jsdelivr.net/npm/tensorflow-models-mobilenet-patch@2.1.1/dist/mobilenet.min.js',
};

export default defineComponent({
  name: 'image-search',

  setup: setup((props: Props) => ({
    uploadUrl: props.uploadUrl || '/search/upload',
    searchUrl: props.searchUrl || '/search',
    messages: {
      invalidFileType: 'Only image files are allowed.',
      fileTooLarge: 'Maximum image size is 2MB.',
      uploadFailed: 'Something went wrong while uploading the image.',
      analysisFailed: 'Something went wrong while analyzing the image.',
      libraryLoadFailed: 'Something went wrong while loading libraries.',
      ...(props.messages || {}),
    },
    librariesLoaded: false,
    isSearching: false,
    uploadedImageUrl: null as string | null,

    async handleImageSelection(event: Event) {
      const image = (event.target as HTMLInputElement).files?.[0];

      if (!image || !this.validateImage(image)) {
        return;
      }

      this.isSearching = true;

      const data = await this.uploadImage(image);

      if (!data) {
        return;
      }

      this.uploadedImageUrl = data.image_url as string;

      const terms = data.engine === 'ai' ? this.parseTerms(data.keywords ?? '') : [];

      if (terms.length) {
        this.completeSearch(terms);
        return;
      }

      await this.analyzeImage();
    },

    validateImage(image: File) {
      if (!image) return false;

      if (!image.type.startsWith('image/')) {
        this.$toaster.error(this.messages.invalidFileType);
        return false;
      }

      if (image.size > MAX_IMAGE_SIZE) {
        this.$toaster.error(this.messages.fileTooLarge);
        return false;
      }

      return true;
    },

    async uploadImage(image: File): Promise<UploadResponse | null> {
      const formData = new FormData();
      formData.append('image', image);

      let response: string | UploadResponse;

      try {
        response = await this.$request(this.uploadUrl, 'POST', formData, {
          credentials: 'include',
        });
      } catch (error) {
        this.$toaster.error(this.messages.uploadFailed);
        this.resetSearch();
        return null;
      }

      const data: UploadResponse = typeof response === 'string' ? { image_url: response } : response || {};

      if (!data.image_url) {
        this.$toaster.error(this.messages.uploadFailed);
        this.resetSearch();
        return null;
      }

      return data;
    },

    async analyzeImage() {
      if (!this.librariesLoaded && !(await this.loadLibraries())) {
        return;
      }

      try {
        const image = await this.waitForPreview();
        const net = await (window as any).mobilenet.load();
        const results = await net.classify(image);

        const terms = results.flatMap((r: any) => this.parseTerms(r.className));

        if (!terms.length) {
          throw new Error('Image classification returned no terms.');
        }

        this.completeSearch(terms);
      } catch (error) {
        this.$toaster.error(this.messages.analysisFailed);
        this.resetSearch();
      }
    },

    /**
     * MobileNet reads the preview element's pixels, so it can only run once the
     * browser has the image. `x-bind:src` flushes on Alpine's next tick, hence
     * the wait before the element is inspected.
     */
    async waitForPreview(): Promise<HTMLImageElement> {
      await this.$nextTick();

      const image = this.$refs.preview as HTMLImageElement | undefined;

      if (!image) {
        throw new Error('Image search preview element is missing.');
      }

      // An `<img>` with no `src` reports `complete`, so the binding has to be
      // checked separately or the load below would never resolve.
      if (!image.getAttribute('src')) {
        throw new Error('Image search preview never received a src.');
      }

      if (image.complete && image.naturalWidth > 0) {
        return image;
      }

      return new Promise<HTMLImageElement>((resolve, reject) => {
        image.addEventListener('load', () => resolve(image), { once: true });
        image.addEventListener('error', () => reject(new Error('Image search preview failed to load.')), {
          once: true,
        });
      });
    },

    parseTerms(value: string) {
      return value
        .split(',')
        .map((term) => term.trim())
        .filter(Boolean);
    },

    completeSearch(terms: string[]) {
      this.storeSearchResults(terms);
      this.redirectToSearchResults(terms);
    },

    storeSearchResults(terms: string[]) {
      localStorage.setItem('searchedImageUrl', this.uploadedImageUrl as string);
      localStorage.setItem('searchedTerms', terms.join('_'));
    },

    redirectToSearchResults(terms: string[]) {
      const url = new URL(this.searchUrl, window.location.origin);
      url.searchParams.set('query', terms[0]);
      url.searchParams.set('image-search', '1');
      window.location.href = url.toString();
    },

    async loadLibraries() {
      try {
        await this.loadScript(LIBRARIES.tensorflow);
        await this.loadScript(LIBRARIES.mobilenet);

        if (!(window as any).mobilenet) {
          throw new Error('MobileNet is unavailable after loading.');
        }

        this.librariesLoaded = true;
        return true;
      } catch (error) {
        this.$toaster.error(this.messages.libraryLoadFailed);
        this.resetSearch();
        return false;
      }
    },

    loadScript(src: string) {
      return new Promise<void>((resolve, reject) => {
        // Don't load script if it's already loaded
        if (document.querySelector(`script[src="${src}"]`)) {
          return resolve();
        }

        const script = document.createElement('script');
        script.src = src;
        script.onload = () => resolve();
        script.onerror = () => reject(new Error(`Failed to load script: ${src}`));
        document.head.appendChild(script);
      });
    },

    resetSearch() {
      this.isSearching = false;
      this.uploadedImageUrl = null;
      if (this.$refs.fileInput) {
        (this.$refs.fileInput as HTMLInputElement).value = '';
      }
    },
  })),

  parts: {
    trigger(api) {
      return {
        type: 'button',
        'x-bind:disabled': () => api.isSearching,
        'x-on:click': () => api.$refs.fileInput?.click?.(),
      };
    },

    fileInput(api) {
      return {
        type: 'file',
        accept: 'image/*',
        'x-ref': 'fileInput',
        'x-on:change': (e: Event) => api.handleImageSelection(e),
      };
    },

    preview(api) {
      return {
        'x-ref': 'preview',
        'x-bind:src': () => api.uploadedImageUrl,
      };
    },
  },
});
