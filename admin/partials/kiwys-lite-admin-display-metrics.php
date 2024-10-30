<?php if ($this->metrics) { ?>
    <div class="relative px-8 pt-6 text-white bg-green-500 pb-18">
        <h3 class="flex items-center text-lg font-medium leading-6 text-white">
            <i class="mr-2 far fa-calendar-alt fa-fw"></i> Aujourd'hui
        </h3>
        <div class="absolute top-0 right-0 flex items-center mt-1 mr-2"><i class="mr-2 fas fa-sync-alt"></i> par heure</div>
        <div class="flex-grow px-8 mt-8">
            <div class="grid grid-cols-2 row-gap-4 col-gap-16">
                <div>
                    <div class="text-lg text-center border-b border-white">Requêtes</div>
                    <div class="text-2xl font-bold text-center"><?php echo esc_html($this->filter($this->metrics["requests"], "bigNumber")); ?></div>
                </div>
                <div>
                    <div class="text-lg text-center border-b border-white">Imps. Publicitaires</div>
                    <div class="text-2xl font-bold text-center"><?php echo esc_html($this->filter($this->metrics["impressions"], "bigNumber")); ?></div>
                </div>
                <div>
                    <div class="text-lg text-center border-b border-white">Contenu Éditorial</div>
                    <div class="text-2xl font-bold text-center"><?php echo esc_html($this->filter($this->metrics["opportunities"], "bigNumber")); ?></div>
                </div>
                <div>
                    <div class="text-lg text-center border-b border-white">Remplissage</div>
                    <div class="text-2xl font-bold text-center"><?php echo esc_html($this->filter($this->metrics["fillrate"], "percentage")); ?></div>
                </div>
                <div>
                    <div class="text-lg text-center border-b border-white">Visibilité</div>
                    <div class="text-2xl font-bold text-center"><?php echo esc_html($this->filter($this->metrics["visibility"], "percentage")); ?></div>
                </div>
                <div>
                    <div class="text-lg text-center border-b border-white">CPM</div>
                    <div class="text-2xl font-bold text-center"><?php echo esc_html($this->filter($this->metrics["cpm"], "currency")); ?></div>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-lg text-center border-b border-white">Gains</div>
                <div class="text-2xl font-bold text-center"><?php echo esc_html($this->filter($this->metrics["earnings"], "currency")); ?></div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 flex items-center justify-end h-12 px-8">
            <a class="flex items-center text-base focus:outline-none focus:shadow-none" href="https://kiwys.me/report"><i class="mr-2 fas fa-chart-bar"></i> Rapport détaillé</a>
        </div>
    </div>
<?php } ?>