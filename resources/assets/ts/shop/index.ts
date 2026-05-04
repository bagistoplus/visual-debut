import { Livewire, Alpine } from '../../../../vendor/livewire/livewire/dist/livewire.esm';
import carousel from 'alpine-headless-ui/carousel';

import collapsible from './components/ui/collapsible';
import accordion from './components/ui/accordion';
import dropdown from './components/ui/dropdown';
import numberInput from './components/ui/number-input';
import slider from './components/ui/slider';
import toasts, { toaster } from './components/ui/toasts';
import modal from './components/ui/modal';
import modals from './plugins/modals';
import confirm from './plugins/confirm';
import helpers from './plugins/helpers';
import addressForm from './features/address-form';
import imageSearch from './features/image-search';
import datagrid from './features/datagrid';
import tabs from './components/ui/tabs';
import mediaGallery from './features/media-gallery';
import productsCompare from './features/products-compare';
import productBundle from './features/product-bundle';
import productCustomizable from './features/product-customizable';
import productForm from './features/product-form';
import variantPicker from './features/variant-picker';
import navigation from './features/navigation';
import productActions from './features/product-actions';
import rating from './components/ui/rating';

// ui components as plugin
Alpine.plugin([accordion, collapsible, dropdown, modal, numberInput, slider, tabs, toasts, rating, carousel]);

// plugins
Alpine.plugin([confirm, helpers, modals, toaster]);

// feature components as plugin
Alpine.plugin([
  addressForm,
  datagrid,
  imageSearch,
  mediaGallery,
  navigation,
  productForm,
  productActions,
  productBundle,
  productCustomizable,
  productsCompare,
  variantPicker,
]);

Livewire.start();
