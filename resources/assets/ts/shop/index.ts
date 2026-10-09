import { Livewire, Alpine } from '../../../../vendor/livewire/livewire/dist/livewire.esm';
import '@bagistoplus/ui/accordion';
import '@bagistoplus/ui/carousel';
import '@bagistoplus/ui/collapsible';
import '@bagistoplus/ui/dialog';
import '@bagistoplus/ui/navigation-menu';
import '@bagistoplus/ui/number-input';
import '@bagistoplus/ui/popover';
import '@bagistoplus/ui/rating';
import '@bagistoplus/ui/slider';

import toasts, { toaster } from './components/ui/toasts';
import confirm from './plugins/confirm';
import helpers from './plugins/helpers';
import addressForm from './features/address-form';
import imageSearch from './features/image-search';
import datagrid from './features/datagrid';
import mediaGallery from './features/media-gallery';
import productsCompare from './features/products-compare';
import productBundle from './features/product-bundle';
import productCustomizable from './features/product-customizable';
import productForm from './features/product-form';
import variantPicker from './features/variant-picker';
import productActions from './features/product-actions';

// ui components as plugin
Alpine.plugin([toasts]);

// plugins
Alpine.plugin([confirm, helpers, toaster]);

// feature components as plugin
Alpine.plugin([
  addressForm,
  datagrid,
  imageSearch,
  mediaGallery,
  productForm,
  productActions,
  productBundle,
  productCustomizable,
  productsCompare,
  variantPicker,
]);

Livewire.start();
