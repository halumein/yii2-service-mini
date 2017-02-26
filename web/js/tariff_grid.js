if (typeof usesgraphcrt == "undefined" || !usesgraphcrt) {
    var usesgraphcrt = {};
}

usesgraphcrt.tariffGrid = {
    init: function () {
        csrfToken = $('meta[name=csrf-token]').attr("content");
        $tariffGrid = $('[data-role=tariff-grid]');
        $btnSubmit = $('[data-role=send-grid]');
        $tariffModal = $('[data-role=tariff-modal]');
        $tariffModalShowBtn = $('[data-role=tariff-modal-btn]');

        $(document).on('mouseenter','.service-prices-table td', this.renderCross);

        $(document).on('mouseleave','.service-prices-table td',function () {
            $('.service-prices-table td').removeClass('hover');
        });

        $tariffModalShowBtn.on('click',function(){
            alert('пиу!');
            url = $(this).data('url');
        });

        $btnSubmit.on('click', function () {
            self = this;
            tariffGrid = usesgraphcrt.tariffGrid.pickingGrid();
            usesgraphcrt.tariffGrid.sendGrid($(self).data('url'),tariffGrid);
        });
    },
    
    renderCross: function () {
        var tr = $(this).parent('tr');
        var Col = tr.find('td').index(this);

        tr.find('td').addClass('hover');
        $('.service-prices-table tr').find('td:eq(' + Col + ')').addClass('hover');
    },

    loadModal: function () {
        
    },

    pickingGrid: function () {
        var tariffGrid = {};
        $('[data-role=tariff-grid]').find('[data-role=tariff-row]').each(function ($key, $value) {
            if ($($value).find('[data-role=tariff-price]').val() != ''
                || $($value).find('[data-role=tariff-discount]').val() != '') {
                tariffGrid[$key] = {
                    'service_id': $($value).find('[data-role=tariff-block]').data('service'),
                    'category_id': $($value).find('[data-role=tariff-block]').data('category'),
                    'price': $($value).find('[data-role=tariff-price]').val(),
                    'discount': $($value).find('[data-role=tariff-discount]').val()
                };
            }
        });
        return tariffGrid;
    },

    sendGrid: function (url,data) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {tariffGrid:data,_csrf : csrfToken},
            success: function (response) {
                if (response.status == 'success') {
                    alert('Сохранилось!');
                    console.log(response);
                }
            }
        });
    }

};

usesgraphcrt.tariffGrid.init();