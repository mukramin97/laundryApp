require('./bootstrap');

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'

import VueSweetalert2 from 'vue-sweetalert2';

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(VueSweetalert2)
      .use(plugin)
      .mount(el)
  },
})

import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init()