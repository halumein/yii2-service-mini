if (typeof usesgraphcrt == "undefined" || !usesgraphcrt) {
    var usesgraphcrt = {};
}

usesgraphcrt.tariffGrid = {
    init: function () {
        csrfToken = $('meta[name=csrf-token]').attr("content");
        $tariffGrid = $('[data-role=tariff-grid]');
        $btnSubmit = $('[data-role=send-grid]');
        $tariffModal = $('[data-role=tariff-modal]');
        $tariffPrice = $('[data-role=tariff-price]');
        $tariffDiscount = $('[data-role=tariff-discount]');
        $tariffModalContent = $('[data-role=tariff-modal-content]');
        $tariffModalShowBtn = $('[data-role=tariff-modal-btn]');
        $alertBlock = $('[data-role=alert]');

        $(document).on('mouseenter', '.service-prices-table td', this.renderCross);

        $(document).on('mouseleave', '.service-prices-table td', function () {
            $('.service-prices-table td').removeClass('hover');
        });

        $tariffDiscount.change(function () {
            self = this;
            $block = $(self).closest('[data-role=tariff-block]');
            usesgraphcrt.tariffGrid.tariffBlockChangeStatus($block);
        });

        $tariffPrice.change(function () {
            self = this;
            $block = $(self).closest('[data-role=tariff-block]');
            usesgraphcrt.tariffGrid.tariffBlockChangeStatus($block);
        });

        $tariffModalShowBtn.on('click', function () {
            url = $(this).data('url');
            data = {
                'service_id': $(this).closest('[data-role=tariff-block]').data('service'),
                'category_id': $(this).closest('[data-role=tariff-block]').data('category')
            };
            usesgraphcrt.tariffGrid.loadModal(url, data);
        });

        $btnSubmit.on('click', function () {
            self = this;
            tariffGrid = usesgraphcrt.tariffGrid.pickingGrid();
            usesgraphcrt.tariffGrid.sendGrid($(self).data('url'), tariffGrid);
        });
    },

    tariffBlockChangeStatus: function ($block) {
        $block.data('status', 'changed').attr('data-status', 'changed');
    },

    renderCross: function () {
        var tr = $(this).parent('tr');
        var Col = tr.find('td').index(this);

        tr.find('td').addClass('hover');
        $('.service-prices-table tr').find('td:eq(' + Col + ')').addClass('hover');
    },

    loadModal: function (url, data) {
        $tariffModalContent.load(url, data);
        $tariffModal.modal('toggle');
    },

    pickingGrid: function () {
        var tariffGrid = {};
        $('[data-role=tariff-grid]').find('[data-role=tariff-row]').each(function ($key, $value) {
            if ($($value).find('[data-role=tariff-block]').data('status') == 'changed') {
                discount = $($value).find('[data-role=tariff-discount]').val();
                price = $($value).find('[data-role=tariff-price]').val();
                if (discount == '') {
                    discount = 0;
                }
                if (price == '') {
                    price = 0;
                }
                tariffGrid[$key] = {
                    'service_id': $($value).find('[data-role=tariff-block]').data('service'),
                    'category_id': $($value).find('[data-role=tariff-block]').data('category'),
                    'price': price,
                    'discount': discount
                };
            }
        });
        return tariffGrid;
    },

    sendGrid: function (url, data) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {tariffGrid: data, _csrf: csrfToken},
            success: function (response) {
                if (response.status == 'success') {
                    $alertBlock.removeClass('error').addClass('success').fadeIn();
                    $alertBlock.html('Данные сохранены!');
                } else {
                    $alertBlock.removeClass('success').addClass('error').fadeIn();
                    $alertBlock.html('Ошибка сохранения!');
                }
                setTimeout(function () {
                    $alertBlock.fadeOut();
                }, 1000);

            }
        });
    }

};

usesgraphcrt.tariffGrid.init();