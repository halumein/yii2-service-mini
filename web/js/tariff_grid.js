if (typeof usesgraphcrt == "undefined" || !usesgraphcrt) {
    var usesgraphcrt = {};
}

usesgraphcrt.tariffGrid = {
    init: function () {
        csrfToken = $('meta[name=csrf-token]').attr("content");
        $tariffGrid = $('[data-role=tariff-grid]');
        $btnSubmit = $('[data-role=send-grid]');
        $tariffModal = $('[data-role=tariff-modal]');
        $tariffModalContent = $('[data-role=tariff-modal-content]');
        $tariffModalShowBtn = $('[data-role=tariff-modal-btn]');
        $alertBlock = $('[data-role=alert]');

        $(document).on('mouseenter','.service-prices-table td', this.renderCross);

        $(document).on('mouseleave','.service-prices-table td',function () {
            $('.service-prices-table td').removeClass('hover');
        });

        $tariffModalShowBtn.on('click',function(){
            url = $(this).data('url');
            data = {
                'service_id': $(this).closest('[data-role=tariff-block]').data('service'),
                'category_id': $(this).closest('[data-role=tariff-block]').data('category')
            };
            usesgraphcrt.tariffGrid.loadModal(url,data);
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

    loadModal: function (url,data) {
        $tariffModalContent.load(url,data);
        $tariffModal.modal('toggle');
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
                    $alertBlock.addClass('success').fadeIn();
                    $alertBlock.html('Данные сохранены!');
                    console.log(response);
                } else {
                    $alertBlock.addClass('error');
                    $alertBlock.html('Что-то пошло не так :(');
                    console.log(response);
                }
                setTimeout(function () {
                    $alertBlock.fadeOut();
                },2000);
            }
        });
    }

};

usesgraphcrt.tariffGrid.init();