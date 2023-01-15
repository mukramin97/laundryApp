require('./bootstrap');

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { SwalMixin } from './swalMixin'

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      //.use(store)
      .use(VueSweetalert2)
      .mixin(SwalMixin)
      .use(plugin)
      .mount(el)
  },
})

import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init()