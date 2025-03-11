<?php include('Template/Main/header.php')?>
<?php
    // $ProductItems = getProductItems();

    ?>
<?php
    $currentProductPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $maxPrice = isset($_GET['maxPrice']) ? (int)$_GET['maxPrice'] : null;
    $selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;

    $totalProducts = getTotalProducts($maxPrice, $selectedCategory);
    
    $perPage = 9;
    $totalPages = ceil($totalProducts / $perPage);
    
    $ProductItems = getProductsForPage($currentProductPage, $perPage, $maxPrice, $selectedCategory);

    $selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;
    if ($selectedCategory === '') {
        $selectedCategory = null;
    }
?>


<main>
    <section class="cinematic-store-section">
        <div class="store-content">
            <!-- Title -->
            <div class="store-header">
                <h2><i class="fas fa-film"></i> Ресурсы для синематиков</h2>
                <p>Профессиональные ассеты для создания кинематографичных роликов</p>    
            </div>

            <!-- Filters -->
            <div class="cinematic-filters">
                <?php
                    $currentCategory = isset($_GET['category']) ? $_GET['category'] : '';
                ?>
                <div class="filter-tabs">
                    
                    <button class="filter-btn <?php echo ($currentCategory === '') ? 'active' : ''; ?>" data-category="">Все</button>
                    <button class="filter-btn <?php echo ($currentCategory === 'Кат-сцены') ? 'active' : ''; ?>" data-category="Кат-сцены">Кат-сцены</button>
                    <button class="filter-btn <?php echo ($currentCategory === 'Шейдеры') ? 'active' : ''; ?>" data-category="Шейдеры">Шейдеры</button>
                    <button class="filter-btn <?php echo ($currentCategory === 'Звуки') ? 'active' : ''; ?>" data-category="Звуки">Звуки</button>
                    <button class="filter-btn <?php echo ($currentCategory === 'Титры') ? 'active' : ''; ?>" data-category="Титры">Титры</button>
                    <button class="filter-btn <?php echo ($currentCategory === 'Звуковые эффекты') ? 'active' : ''; ?>" data-category="Звуковые эффекты">Звуковые эффекты</button>
                    <button class="filter-btn <?php echo ($currentCategory === 'Визуальные эффекты') ? 'active' : ''; ?>" data-category="Визуальные эффекты">Визуальные эффекты</button>
                    <button class="filter-btn <?php echo ($currentCategory === 'Переходы') ? 'active' : ''; ?>" data-category="Переходы">Переходы</button>
                    <button class="filter-btn <?php echo ($currentCategory === 'Освещение') ? 'active' : ''; ?>" data-category="Освещение">Освещение</button>
                    <button class="filter-btn <?php echo ($currentCategory === 'Анимации') ? 'active' : ''; ?>" data-category="Анимации">Анимации</button>
                </div>
                <br>
                <div class="price-filter">
                    <label for="priceRange">Цена: </label>
                    <input type="range" id="priceRange" name="priceRange" min="0" max="10000" step="100" value="<?= $maxPrice ?>">
                    <span id="priceValue"><?= $maxPrice ?>₽</span> 
                </div>
            </div>

            <!-- Products -->
            <div class="cinematic-grid">
                <?php foreach ($ProductItems as $item) { ?>
                    <article class="cinematic-item">
                        <div class="item-preview">
                            <?php if($item['preview_type'] == 'video') {?>
                                <video muted loop autoplay class="preview-video">
                                    <source src="Template/Img/Products/<?php echo $item['preview_url']; ?>" type="video/mp4">
                                </video>
                            <?php } else { ?>
                                <img src="Template/Img/Products/<?php echo $item['preview_url']; ?>" alt="<?php echo $item['title']; ?>" class="preview-image">
                            <?php } ?>


                            <?php if ($item['badge_text']) { ?>
                                <div class="item-badge">
                                    <i class="<?php echo $item['badge_icon']; ?>"></i> <?php echo $item['badge_text']; ?>
                                </div>
                            <?php } ?>
                            <button class="item-like">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>

                        <div class="item-info">
                                <h3><?php echo $item['title']; ?></h3>
                                <div class="item-meta">
                                    <span class="item-category"><?php echo $item['category']; ?></span>
                                    <div class="item-stats">
                                        <?php echo $item['stats']; ?>
                                    </div>
                                </div>

                                <p class="item-desc"><?php echo $item['description']; ?></p>

                                <div class="item-footer">
                                    <div class="item-pricing">
                                        <span class="price">₽<?php echo number_format($item['price'], 0, ',', ' '); ?></span>
                                        <?php if ($item['old_price']) { ?>
                                            <span class="old_price">₽<?php echo number_format($item['old_price'], 0, ',', ' '); ?></span>
                                        <?php } ?>
                                    </div>
                                    <button class="cart-btn" 
                                            data-product-id="<?php echo $item['id']; ?>" 
                                            data-product-title="<?php echo $item['title']; ?>" 
                                            data-product-price="<?php echo $item['price']; ?>">
                                        <i class="fas fa-shopping-cart"></i> Добавить
                                    </button>
                                </div>
                        </div>
                    </article>
                <?php } ?>
                
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php if ($currentProductPage > 1) { ?>
                    <a href="?page=<?php echo $currentProductPage - 1; ?>&maxPrice=<?= $maxPrice; ?> &category=<?= $selectedCategory; ?>" class="pagination-btn">Назад</a>
                <?php } ?>

                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <a href="?page=<?php echo $i; ?>&maxPrice=<?= $maxPrice; ?> &category=<?= $selectedCategory; ?>" class="pagination-btn <?php echo ($i == $currentProductPage) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php } ?>

                <?php if ($currentProductPage < $totalPages) { ?>
                    <a href="?page=<?php echo $currentProductPage + 1; ?>&maxPrice=<?php echo $maxPrice; ?> &category=<?= $selectedCategory; ?>" class="pagination-btn">Вперед</a>
                <?php } ?>
            </div>

        </div>
    </section>
</main>

<script>
    document.getElementById('priceRange').addEventListener('input', function() {
        document.getElementById('priceValue').textContent = this.value;
        updateUrlWithFilters();
    });

    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const category = this.getAttribute('data-category');
            updateUrlWithFilters(category);
        });
    });
   

    

    function updateUrlWithFilters(category = '') {
        const priceRange = document.getElementById('priceRange').value;
        const url = new URL(window.location.href);
        url.searchParams.set('maxPrice', priceRange);
        url.searchParams.set('category', category);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }
</script>

<?php include('Template/Main/footer.php')?>