<template>
  <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
    {{ status }}
  </div>

  <div class="text-center">
    <h2 class="my-6 text-3xl font-bold text-gray-900">¡Bienvenido de nuevo!</h2>
  </div>
  <!-- Login con redes sociales -->
  <article>
    <div class="flex flex-row justify-center items-center space-x-3">
      <span
        class="w-full h-11 items-center justify-center inline-flex  font-bold text-lg text-red-400 hover:text-white rounded
        bg-white hover:bg-red-500 hover:shadow-lg cursor-pointer transition ease-in duration-300 border-2 border-red-500"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="icon icon-tabler icon-tabler-brand-google w-6 h-6"
          viewBox="0 0 24 24"
          stroke-width="2"
          stroke="currentColor"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M17.788 5.108a9 9 0 1 0 3.212 6.892h-8"></path>
        </svg>
      </span>
    </div>
    <div class="flex items-center justify-center space-x-2 my-3">
      <span class="h-px w-full bg-gray-300"></span>
      <span class="text-gray-500 font-normal">O</span>
      <span class="h-px w-full bg-gray-300"></span>
    </div>
  </article>
  <!-- formulario de login -->
  <form @submit.prevent="submit" novalidate>
    <div>
      <breeze-label for="email" value="Email" />
      <breeze-input
        id="email"
        type="email"
        class="mt-1 block w-full"
        v-model="form.email"
        required
        autofocus
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
        autocomplete="current-password"
      />
    </div>

    <div class="mt-4 flex justify-between items-center">
      <label class="flex items-center">
        <breeze-checkbox name="remember" v-model:checked="form.remember" />
        <span class="ml-2 text-sm text-gray-600">Recordar</span>
      </label>
      <inertia-link
        v-if="canResetPassword"
        :href="route('password.request')"
        class="hover:underline text-sm text-gray-600 hover:text-gray-900"
      >
        ¿Has olvidado la contraseña?
      </inertia-link>
    </div>

    <div class="mt-4">
      <breeze-validation-errors class="my-4" />
      <breeze-button
        class="w-full"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Iniciar Sesión
      </breeze-button>
    </div>
    <div class="mt-4 flex justify-end items-center">
      <inertia-link
        v-if="canResetPassword"
        :href="route('register')"
        class="hover:underline text-sm text-gray-600 hover:text-gray-900"
      >
        ¿Aún no tienes cuenta? Registrarse
      </inertia-link>
    </div>
  </form>
</template>

<script>
import BreezeButton from '@/Components/Button'
import BreezeGuestLayout from '@/Layouts/Guest'
import BreezeInput from '@/Components/Input'
import BreezeCheckbox from '@/Components/Checkbox'
import BreezeLabel from '@/Components/Label'
import BreezeValidationErrors from '@/Components/ValidationErrors'

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeButton,
    BreezeInput,
    BreezeCheckbox,
    BreezeLabel,
    BreezeValidationErrors,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false,
      }),
    }
  },

  methods: {
    submit() {
      this.form.post(this.route('login'), {
        onFinish: () => this.form.reset('password'),
      })
    },
  },
}
</script>
