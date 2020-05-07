<?php

/*

Template Name: Форма

*/

get_header();
?>
<?while ( have_posts() ) : the_post();
?>

<section class="chose-couse">
    <form action="https://ek-autovl.ru/worde" method="post" class="chose-couse__form" id="form_submit_word">
        <a href="/" class="link_main">Вернуться на главную</a>
        <h1 class="chose-couse__header">Заполнение договора</h1>
        <div class="chose-couse__description">На данной странице можно заполнить договор онлайн без посещения офиса.</div>
        <h4>Личные данные</h4>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="fio" class="chose-couse__form__label">Ваше ФИО</label>
                <input type="text" name="fio" class="chose-couse__form__input chose-couse__form__name required">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="address" class="chose-couse__form__label">Ваш адрес</label>
                <input type="text" name="address" class="chose-couse__form__input chose-couse__form__name required">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="passport" class="chose-couse__form__label">Данные паспорта</label>
                <input type="text" name="passport" class="chose-couse__form__input chose-couse__form__name required">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="phone" class="chose-couse__form__label">Ваш номер телефона</label>
                <input type="text" name="phone" class="chose-couse__form__input chose-couse__form__name phone-mask required">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="email" class="chose-couse__form__label">Ваш email</label>
                <input type="text" name="email" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="cart" class="chose-couse__form__label">Ваш Карта Клиента</label>
                <input type="text" name="cart" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>

        <h4>Информация об автомобиле</h4>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="mark" class="chose-couse__form__label">Марка, модель, год выпуска</label>
                <input type="text" name="mark" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="cusov" class="chose-couse__form__label">№ Кузова, модель двигателя</label>
                <input type="text" name="cusov" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="aucraiting" class="chose-couse__form__label">Аукционная оценка, пробег автомобиля</label>
                <input type="text" name="aucraiting" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="color" class="chose-couse__form__label">Цвет</label>
                <input type="text" name="color" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="transmissiya" class="chose-couse__form__label">Трансмиссия</label>
                <input type="text" name="transmissiya" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="compl" class="chose-couse__form__label">Комплектация</label>
                <input type="text" name="compl" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="out" class="chose-couse__form__label">Внешнее оснащение</label>
                <input type="text" name="out" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="in" class="chose-couse__form__label">Внутреннее оснащение</label>
                <input type="text" name="in" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="price" class="chose-couse__form__label">Примерная стоимость в городе Владивостоке</label>
                <input type="text" name="price" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="price_end" class="chose-couse__form__label">Конечная стоимость в городе Владивостоке</label>
                <input type="text" name="price_end" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="numblot" class="chose-couse__form__label">№ Лота, наименование аукциона, дата проведения торгов</label>
                <input type="text" name="numblot" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-couse__form__row">
            <div class="chose-couse__form__input-group">
                <label for="aucdate" class="chose-couse__form__label">Аукционная оценка, дата торгов</label>
                <input type="text" name="aucdate" class="chose-couse__form__input chose-couse__form__name">
            </div>
        </div>
        <div class="chose-cource__form__footer">
            <div class="chose-cource__form__footer__text">Нажимая на кнопку «Отправить» вы принимаете <a href="#">условия обработки информации</a></div>
            <button type="submit" class="chose-cource__form__footer__btn">Отправить</button>
        </div>
    </form>
</section>



<?php endwhile; ?>

<?php get_footer();?>