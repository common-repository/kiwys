<div class="flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-md w-full">
    <div>
      <img class="mx-auto w-auto" src="<?php echo esc_url(plugin_dir_url(__FILE__) . '../img/logo.png'); ?>" alt="Workflow">
      <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
        Se connecter à son compte
      </h2>
      <p class="mt-2 text-center text-sm leading-5 text-gray-600">
        Ou
        <a href="https://kiwys.me/register" target="_blank" class="font-medium text-green-500 hover:text-green-500 focus:outline-none focus:underline transition ease-in-out duration-150">
          créer un compte kiwys
        </a>
      </p>
    </div>
    <form class="mt-8" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
      <input type="hidden" name="kiwys-lite-nonce" value="<?php echo wp_create_nonce('kiwys-lite-nonce'); ?>" />
      <input type="hidden" name="action" value="login" />
      <div class="rounded-md shadow-sm">
        <div>
          <input aria-label="Email address" name="email" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5" placeholder="Adresse email">
        </div>
        <div class="-mt-px">
          <input aria-label="Password" name="password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5" placeholder="Mot de passe">
        </div>
      </div>

      <div class="mt-6 flex items-center justify-end">

        <div class="text-sm leading-5">
          <a href="https://kiwys.me/password/reset" target="_blank" class="font-medium text-green-500 hover:text-green-500 focus:outline-none focus:underline transition ease-in-out duration-150">
            Mot de passe oublié ?
          </a>
        </div>
      </div>

      <div class="mt-6">
        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-500 hover:bg-green-500 focus:outline-none focus:border-green-500 focus:shadow-outline-green active:bg-green-500 transition duration-150 ease-in-out">
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <svg class="h-5 w-5 text-green-500 group-hover:text-green-500 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
          </span>
          Connexion
        </button>
      </div>
    </form>
  </div>
</div>