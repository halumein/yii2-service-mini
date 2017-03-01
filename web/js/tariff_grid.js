if (typeof usesgraphcrt == "undefined" || !usesgraphcrt) {
    var usesgraphcrt = {};
}

usesgraphcrt.tariffGrid = {
    init: function () {
        csrfToken = $('meta[name=csrf-token]').attr("content");
        $tariffGrid = $('[data-role=tariff-grid]');
        $btnSubmit = $('[data-role=send-grid]');
        $tariffInput = $('[data-role=tariff-price],[data-role=tariff-discount]');
        $tariffModal = $('[data-role=tariff-modal]');
        $tariffModalContent = $('[data-role=tariff-modal-content]');
        $tariffModalShowBtn = $('[data-role=tariff-modal-btn]');
        $alertBlock = $('[data-role=alert]');

        $(document).on('mouseenter', '.service-prices-table td', this.renderCross);

        $(document).on('mouseleave', '.service-prices-table td', function () {
            $('.service-prices-table td').removeClass('hover');
        });

        $tariffInput.keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: Ctrl+C
                (e.keyCode == 67 && e.ctrlKey === true) ||
                // Allow: Ctrl+X
                (e.keyCode == 88 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        $tariffInput.keyup(function (e) {
            var income = +$paymentInput.val();
            if (income > paymentCost) {
                $paymentChange.html(income - paymentCost);
            } else {
                $paymentChange.html(0);
            }

            if (e.keyCode == 13) {
                halumein.paymentForm.sendData(e);
            }
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
            if ($($value).find('[data-role=tariff-discount]').val() != $($value).find('[data-role=tariff-discount]').data('discount')
                || $($value).find('[data-role=tariff-price]').val() != $($value).find('[data-role=tariff-price]').data('price')) {
                
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