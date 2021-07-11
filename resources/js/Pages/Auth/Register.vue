<template>
<div class="text-center">
    <h2 class="my-6 text-3xl font-bold text-gray-900">Registrarse</h2>
  </div>
  <form @submit.prevent="submit" novalidate>
    <div>
      <breeze-label for="name" value="Nombre" />
      <breeze-input
        id="name"
        type="text"
        class="mt-1 block w-full"
        v-model="form.name"
        required
        autofocus
        autocomplete="name"
      />
    </div>

    <div class="mt-4">
      <breeze-label for="email" value="Email" />
      <breeze-input
        id="email"
        type="email"
        class="mt-1 block w-full"
        v-model="form.email"
        required
        autocomplete="username"
      />
    </div>

    <div class="mt-4">
      <breeze-label for="password" value="Contraseña" />
      <breeze-input
        id="password"
        type="password"
        class="mt-1 block w-full"
        v-model="form.password"
        required
        autocomplete="new-password"
      />
    </div>

    <div class="mt-4">
      <breeze-label for="password_confirmation" value="Confirmar Contraseña" />
      <breeze-input
        id="password_confirmation"
        type="password"
        class="mt-1 block w-full"
        v-model="form.password_confirmation"
        required
        autocomplete="new-password"
      />
    </div>
    <div class="mt-4">
      <!-- errores -->
      <breeze-validation-errors class="my-4" />
      <breeze-button
        class="w-full"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Registrarse
      </breeze-button>
    </div>
    <div class="flex items-center justify-end mt-4">
      <inertia-link
        :href="route('login')"
        class="hover:underline text-sm text-gray-600 hover:text-gray-900"
      >
        ¿Ya tienes cuenta? Iniciar Sesión
      </inertia-link>
    </div>
  </form>
</template>

<script>
import BreezeButton from '@/Components/Button'
import BreezeGuestLayout from '@/Layouts/Guest'
import BreezeInput from '@/Components/Input'
import BreezeLabel from '@/Components/Label'
import BreezeValidationErrors from '@/Components/ValidationErrors'

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
  },

  data() {
    return {
      form: this.$inertia.form({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false,
      }),
    }
  },

  methods: {
    submit() {
      this.form.post(this.route('register'), {
        onFinish: () => this.form.reset('password', 'password_confirmation'),
      })
    },
  },
}
</script>
