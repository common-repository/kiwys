<div class="flex w-full h-12 px-8 mb-4 text-base bg-white">
    <div class="flex items-center justify-center flex-shrink-0 mr-2">
        <img class="w-8 h-8 rounded-full" src="<?php echo esc_url(plugin_dir_url( __FILE__ ) . '../img/icon.jpg'); ?>" />
    </div>
    <a href="<?php echo esc_url(admin_url('admin.php?page=kiwys-lite')); ?>" class="focus:outline-none focus:shadow-none px-2 flex items-center justify-center border-b-4 border-green-500 <?php echo $_GET["page"] == "kiwys-lite" ? "border-green-500" : "border-opacity-0" ?> cursor-pointer hover:border-opacity-100 transition-all duration-75">Configuration</a>
    <a href="https://kiwys.me/invoices" target="_blank" class="flex items-center justify-center px-2 transition-all duration-75 border-b-4 border-green-500 border-opacity-0 cursor-pointer focus:outline-none focus:shadow-none hover:border-opacity-100">Paiement</a>
    <a href="https://kiwys.me/dashboard" target="_blank" class="flex items-center justify-center px-2 transition-all duration-75 border-b-4 border-green-500 border-opacity-0 cursor-pointer focus:outline-none focus:shadow-none hover:border-opacity-100">Mon compte</a>
    <a href="#" onclick="event.preventDefault(); document.getElementById('kiwys-logout').submit();" class="flex items-center justify-center px-2 ml-auto transition-all duration-75 border-b-4 border-green-500 border-opacity-0 cursor-pointer focus:outline-none focus:shadow-none hover:border-opacity-100">Déconnexion</a>
    <form id="kiwys-logout" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="kiwys-lite-nonce" value="<?php echo wp_create_nonce('kiwys-lite-nonce'); ?>" />
        <input type="hidden" name="action" value="logout" />
    </form>
</div>