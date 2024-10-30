<div class="bg-white px-8 py-6">
    <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="kiwys-lite-nonce" value="<?php echo wp_create_nonce('kiwys-lite-nonce'); ?>" />
        <input type="hidden" name="action" value="update" />
        <div>
            <div>
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Configuration
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                        Paramétrez votre format comme vous le souhaitez.
                    </p>
                </div>
                <div class="mt-6">
                    <div role="group">
                        <div>
                            <div>
                                <div class="text-base leading-6 font-medium text-gray-900" id="label-email">
                                    Activer la monétisation
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="max-w-lg">
                                    <div class="relative flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="activate" name="activate" type="checkbox" class="form-checkbox h-4 w-4 text-green-600 transition duration-150 ease-in-out" <?php echo get_option(self::MONETIZATION_ACTIVATED_OPTION_NAME, false) ? "checked" : ""; ?>>
                                        </div>
                                        <div class="ml-3 text-sm leading-5">
                                            <label for="activate" class="font-medium text-gray-700">Activé ?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="group" class="mt-4">
                        <div>
                            <div>
                                <div class="text-base leading-6 font-medium text-gray-900" id="label-email">
                                    Catégorie du contenu
                                </div>
                            </div>
                            <div>
                                <div class="max-w-lg rounded-md shadow-sm">
                                    <p class="text-sm leading-5 text-gray-500 mb-4">Selectionnez la catégorie de votre contenu.</p>
                                    <?php $overrideCategory = get_option(self::OVERRIDE_CATEGORY_OPTION_NAME, null); ?>
                                    <select id="category" name="category" class="block form-select w-full transition duration-150 ease-in-out text-base">
                                        <option value="0" <?php echo $overrideCategory == null ? "selected" : ""; ?>>Automatique</option>
                                        <?php foreach ($this->categories as $category) { ?>
                                            <option value="<?php echo esc_attr($category["id"]); ?>" <?php echo $overrideCategory == $category["id"] ? "selected" : ""; ?>><?php echo esc_html($category["name"]); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="group" class="mt-4">
                        <div>
                            <div>
                                <div class="text-base leading-6 font-medium text-gray-900" id="label-email">
                                    Types de pages
                                </div>
                            </div>
                            <div>
                                <div class="max-w-lg">
                                    <p class="text-sm leading-5 text-gray-500 mb-4">Types de pages sur lesquels insérer le format.</p>
                                    <?php $i = 0; ?>
                                    <?php $actives_post_types = get_option(self::ACTIVE_POST_TYPES_OPTION_NAME, []); ?>
                                    <?php foreach (get_post_types(['public'   => true], 'objects') as $key => $type) { ?>
                                        <div class="relative flex items-start <?php if ($i !== 0) { ?> mt-4 <?php } ?>">
                                            <div class="flex items-center h-5">
                                                <input id="<?php echo esc_attr("post_types." . $key); ?>" name="<?php echo esc_attr("post_types[" . $key . "]"); ?>" type="checkbox" class="form-checkbox h-4 w-4 text-green-600 transition duration-150 ease-in-out" <?php echo in_array($key, $actives_post_types) ? "checked" : ""; ?>>
                                            </div>
                                            <div class="ml-3 text-sm leading-5">
                                                <label for="<?php echo esc_attr("post_types." . $key); ?>" class="font-medium text-gray-700"><?php echo esc_html($type->label); ?></label>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-200 pt-5">
            <div class="flex justify-end">
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-500 focus:outline-none focus:shadow-outline-green active:bg-green-700 transition duration-150 ease-in-out">
                        Enregistrer les modifications
                    </button>
                </span>
            </div>
        </div>
    </form>
</div>