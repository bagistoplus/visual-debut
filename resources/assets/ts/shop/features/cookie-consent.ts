import type { Alpine as AlpineType } from 'alpinejs';

interface CookieOptions {
  domain: string | null;
  secure: boolean;
  sameSite: string | null;
}

interface BannerProps {
  cookie: CookieOptions;
  dialog: string;
}

interface PreferencesProps {
  cookie: CookieOptions;
  redirect: string | null;
}

type DialogElement = HTMLElement & { show(): void; hide(): void };

const CONSENT = 'cookie-consent';
const STRICTLY_NECESSARY = 'strictly_necessary';
const SAVED_EVENT = 'visual:cookie-consent';

// Regulators ask for consent again after about a year
const MAX_AGE = 60 * 60 * 24 * 365;

const readCookie = (name: string) =>
  document.cookie
    .split('; ')
    .find((pair) => pair.startsWith(`${name}=`))
    ?.slice(name.length + 1);

const writeCookie = (name: string, value: string, options: CookieOptions) => {
  let cookie = `${name}=${value}; path=/; max-age=${MAX_AGE}`;

  if (options.domain) {
    cookie += `; domain=${options.domain}`;
  }

  if (options.secure) {
    cookie += '; secure';
  }

  if (options.sameSite) {
    cookie += `; samesite=${options.sameSite}`;
  }

  document.cookie = cookie;
};

const saveChoices = (choices: Record<string, boolean>, options: CookieOptions) => {
  writeCookie(STRICTLY_NECESSARY, 'true', options);

  Object.entries(choices).forEach(([name, accepted]) => writeCookie(name, String(accepted), options));

  writeCookie(CONSENT, Object.values(choices).some(Boolean) ? '1' : '0', options);

  window.dispatchEvent(new CustomEvent(SAVED_EVENT));
};

// The optional categories; strictly necessary is always on
const CATEGORIES = ['basic_interaction', 'experience_enhancement', 'measurements', 'targeting_advertising'];

const allChoices = (accepted: boolean) => Object.fromEntries(CATEGORIES.map((name) => [name, accepted]));

export default function (Alpine: AlpineType) {
  Alpine.data('VisualCookieBanner', (props: BannerProps) => ({
    visible: false,

    init() {
      // Any value is a decision; 0 records a refusal
      this.visible = readCookie(CONSENT) === undefined;

      window.addEventListener(SAVED_EVENT, () => (this.visible = false));
    },

    accept() {
      saveChoices(allChoices(true), props.cookie);
    },

    reject() {
      saveChoices(allChoices(false), props.cookie);
    },

    customize() {
      (document.getElementById(props.dialog) as DialogElement | null)?.show();
    },
  }));

  Alpine.data('VisualCookiePreferences', (props: PreferencesProps) => ({
    choices: Object.fromEntries(CATEGORIES.map((name) => [name, readCookie(name) === 'true'])),

    acceptAll() {
      this.choices = allChoices(true);
      this.save();
    },

    rejectAll() {
      this.choices = allChoices(false);
      this.save();
    },

    save() {
      saveChoices(this.choices, props.cookie);

      if (props.redirect) {
        window.location.href = props.redirect;

        return;
      }

      (this.$root.closest('ui-dialog') as DialogElement | null)?.hide();
    },
  }));
}
