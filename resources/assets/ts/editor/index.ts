import './style.css';
import RadiusPicker from './components/RadiusPicker.vue';

document.addEventListener('visual:editor:ready', (event) => {
  const { editor } = (event as CustomEvent).detail;

  editor.ui.registerPropertyField({
    type: 'radius',
    render: RadiusPicker,
  });
});
