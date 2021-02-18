<form id="property_filter">
    <div class="row">
        <div class="input-group col-12">
            <label for="property_title">Название обьекта</label>
            <input id="property_title" name="property_title" type="text">
        </div>
        <div class="input-group col-sm-4">
            <label for="property_floors">Количество этажей</label>
            <select name="property_floors" id="property_floors">
                <option value="">Без разницы</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
            </select>
        </div>
        <div class="input-group col-sm-4">
            <label for="prioperty_type">Тип строения</label>
            <select name="prioperty_type" id="prioperty_type">
                <option value="">Вообще пофиг</option>
                <option value="Панель">Панель</option>
                <option value="Кирпич">Кирпич</option>
                <option value="Пеноблок">Пеноблок</option>
            </select>
        </div>
        <div class="input-group col-sm-4">
            <label for="prioperty_eko">Экологичность</label>
            <select name="prioperty_eko" id="prioperty_eko">
                <option value="">По барабану</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <h4 class="col-12">Помещения</h4>
        <div class="input-group-checkbox col-12">
            <label class="d-inline" for="property_premises_include">Раскрывать и фильтровать по помещениям</label>
            <input class="d-inline" id="property_premises_include" name="property_premises_include" type="checkbox">
        </div>
        <div class="input-group col-6">
            <label for="property_premises_square_max">Площадь Макс</label>
            <input id="property_premises_square_max" name="property_premises_square_max" type="text">
        </div>
        <div class="input-group col-6">
            <label for="property_premises_square_min">Площадь Мин</label>
            <input id="property_premises_square_min" name="property_premises_square_min" type="text">
        </div>
        <div class="input-group col-sm-4">
            <label for="property_premises_rooms">Количество комнат</label>
            <select name="property_premises_rooms" id="property_premises_rooms">
                <option value="">Можно и без</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>

        <div class="input-group-checkbox col-sm-4">
            <label class="d-inline" for="property_premises_balcony">С балконом</label>
            <input class="d-inline" id="property_premises_balcony" name="property_premises_balcony" type="checkbox">
        </div>
        <div class="input-group-checkbox col-sm-4">
            <label for="property_premises_bathroom">С санузелом</label>
            <input id="property_premises_bathroom" name="property_premises_bathroom" type="checkbox">
        </div>
        <div class="col-12">
            <button>Поиск</button>
        </div>
    </div>    
</form>

<div id="searcResults">
    <span>Тут будут отображены результаты поиска</span>
</div>

<script>
    jQuery(document).ready(function($) {
        $("#property_filter").submit(function(event) {
            showPosts(0);
            return false;
        });
    });

    function showPosts(shownPosts){
        var data = {
            action: 'Property_ajax_search',
            data: jQuery("#property_filter").serialize(),
            offset: shownPosts
        };

        // с версии 2.8 'ajaxurl' всегда определен в админке
        jQuery.post( myajax.url, data, function(response) {
            jQuery("#searcResults").html(response);
        });
    }
    </script>