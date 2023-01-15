import VueSweetalert2 from 'vue-sweetalert2';

export const SwalMixin = {
  methods: {
    swalMixin(title, text) {
      this.$swal({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        text: text,
        icon: title,
        timer: 3000,
        timerProgressBar: true
      })
    }
  }
}