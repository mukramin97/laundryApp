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
    },
    swalConfirm(callback) {
      return this.$swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          callback();
        }
      })
    }
  }
}