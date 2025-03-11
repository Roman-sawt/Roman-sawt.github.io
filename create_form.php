<?php include('Template/Main/header.php')?>

    <main>
        <section class="order-section">
            <div class="order-content">
                <h1 class="order-title">Настройте ваш синематик</h1>

                <form class="order-form" id="orderForm" enctype="multipart/form-data">
                    <!-- Block info about project -->
                    <div class="form-section">
                        <h2 class="form-subtitle">Основные параметры</h2>

                        <div class="input-group">
                            <input type="text" name="project_name" required>
                            <label>Название проекта</label>
                            <span class="highlight"></span>
                        </div>

                        <div class="input-row">
                            <div class="input-group half">
                                <input type="email" name="email" required>
                                <label>Ваш Email</label>
                                <span class="highlight"></span> 
                            </div>

                            <div class="input-group half">
                                <input type="tel" name="phone" required>
                                <label>Контактный телефон</label>
                                <span class="highlight"></span> 
                            </div>
                        </div>
                    </div>

                    <!-- block setting cinematics -->
                    <div class="form-section">
                        <h2 class="form-subtitle">Настройки ролика</h2>

                        <div class="input-row">
                            <div class="input-group third">
                                <select name="video_type" required>
                                    <option value=""></option>
                                    <option>Игровой синематик</option>
                                    <option>Рекламный ролик</option>
                                    <option>Короткометражка</option>
                                </select>
                                <label>Тип ролика</label>
                                <span class="highlight"></span>
                            </div>

                            <div class="input-group third">
                                <input type="number" name="duration" min="30" max="600" required>
                                <label>Длительность (секунд)</label>
                                <span class="highlight"></span>
                            </div>

                            <div class="input-group third">
                                <input type="date" name="deadline" required>
                                <label>Желаемый срок</label>
                                <span class="highlight"></span>
                            </div>
                        </div>

                        <div class="input-group">
                            <textarea name="description" rows="4" required></textarea>
                            <label>Описание идеи</label>
                            <span class="highlight"></span>
                        </div>
                    </div>

                    <!-- dop-Option -->
                    <div class="form-section">
                        <h2 class="form-subtitle">Дополнительные опции</h2>

                        <div class="option-grid">
                            <label class="option-checkbox">
                                <input type="checkbox" name="concept_art">
                                <span class="checkmark"></span>
                                создание концепт-артов
                            </label>

                            <label class="option-checkbox">
                                <input type="checkbox" name="professional_sound">
                                <span class="checkmark"></span>
                                Профессиональный звук
                            </label>

                            <label class="option-checkbox">
                                <input type="checkbox" name="logo_animation">
                                <span class="checkmark"></span>
                                Анимация логотипа
                            </label>
                        </div>
                    </div>

                    <!-- Load file -->
                    <div class="form-section">
                        <h2 class="form-subtitle">Прикрепите материалы</h2>

                        <div class="file-upload">
                            <input type="file" name="files[]" multiple>
                            <div class="upload-area">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Перетащите файлы или кликните для загрузки</p>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">Отправить заявку</button>
                </form>
            </div>
        </section>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderForm = document.getElementById('orderForm');

            orderForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch('vendor/create_cinematic.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        orderForm.reset(); 
                    } else {
                        alert(data.message);
                    }
                });
            });
        });
        
    </script>
<?php include('Template/Main/footer.php')?>