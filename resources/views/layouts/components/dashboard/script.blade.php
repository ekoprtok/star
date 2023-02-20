<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="{{ asset('account/assets/js/bundle.js?ver=3.0.2') }}"></script>
<script src="{{ asset('account/assets/js/scripts.js?ver=3.0.2') }}"></script>
<script src="https://cdn3.devexpress.com/jslib/17.1.6/js/dx.all.js"></script>
<script>

    $.ajaxSetup({
        headers: {
            'Authorization': 'Bearer {{ Auth::user()->web_token }}'
        }
    });

    class GaugeChart {
        constructor(element, params) {
            this._element       = element;
            this._initialValue  = params.initialValue;
            this._higherValue   = params.higherValue;
            this._title         = params.title;
            this._subtitle      = params.subtitle;
        }

        _buildConfig() {
            let element = this._element;

            return {
                value: this._initialValue,
                valueIndicator: {
                    color: '#FFFFFF'
                },

                geometry: {
                    startAngle: 180,
                    endAngle: 360
                },

                scale: {
                    startValue: 0,
                    endValue: this._higherValue,
                    customTicks: [0, 25, 50, 75, 100],
                    tick: {
                        length: 5
                    },

                    label: {
                        font: {
                            color: '#87959f',
                            size: 9,
                            family: '"Open Sans", sans-serif'
                        }
                    }
                },

                title: {
                    verticalAlignment: 'bottom',
                    text: this._title,
                    font: {
                        family: '"Open Sans", sans-serif',
                        //   color: '#fff',
                        size: 0
                    },

                    subtitle: {
                        text: this._subtitle,
                        font: {
                            family: '"Open Sans", sans-serif',
                            // color: '#fff',
                            weight: 500,
                            size: 22
                        }
                    }
                },



                onInitialized: function() {
                    // let currentGauge = $(element);
                    // let circle = currentGauge.find('.dxg-spindle-hole').clone();
                    // let border = currentGauge.find('.dxg-spindle-border').clone();

                    // currentGauge.find('.dxg-title text').first().attr('y', 48);
                    // currentGauge.find('.dxg-title text').last().attr('y', 28);
                    // currentGauge.find('.dxg-value-indicator').append(border, circle);
                }
            };
        }

        init() {
            $(this._element).dxCircularGauge(this._buildConfig());
        }
    }

    function setMeter() {
        $('.gauge').each(function(index, item) {
            let dataPr = $(this).data('value');
            let num    = (dataPr >= 0) ? dataPr : getRandomArbitrary(10, 99);
            let params = {
                initialValue: num,
                higherValue: 100,
                title: 'Progress',
                subtitle: `${parseFloat(num)}%`
            };
            let gauge = new GaugeChart(item, params);
            gauge.init();
        });
    }

    function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
    }

    @if(!Route::is('dashboard.admin.detail.user'))
    // info dashboard
    getDashboard();
    function getDashboard(start = null, end = null) {
        $.ajax({
            url      : "{{ route('admin.dashboard') }}",
            data     : {
                id : "{{ Auth::user()->id }}",
                startDate : start,
                endDate   : end
            },
            dataType : 'jSON',
            error: function(request, status, error) {
                showResponseHeader(request);
            },
            success: function(response) {
                setHtmlProps(response)
            }
        })
    }
    @endif
</script>

<script>
    function showResponseHeader(response) {
        if (response.status == 422) {
            let _errors = JSON.parse(response.responseText);
            let errors = _errors.errors;
            let keys = Object.keys(errors);
            keys.map((item, index) => {
                $('.' + item + '_err').html(errors[item].toString());
            });
        } else if (response.status != 200) {
            let _errors = JSON.parse(response.responseText);
            toastr.clear();
            NioApp.Toast(_errors.message, 'error', {
                position: 'top-right'
            });
        }
    }

    function setEditProps(response) {
        let keys = Object.keys(response);
        keys.map((item, index) => {
            $(`input[name="${item}"]`).val(response[item]);
            $(`textarea[name="${item}"]`).val(response[item]);
            $(`select[name="${item}"]`).val(response[item]);
        })
    }

    function setHtmlProps(response) {
        let keys = Object.keys(response);
        keys.map((item, index) => {
            $(`.${item}`).html(response[item]);
            if (item == 'notification_count') {
                if (response[item] > 0) {
                    $('.icon-notif').addClass('icon-status icon-status-info');
                    let notifContent = '';
                    response.notification.map((item, index) => {
                        notifContent += `
                            <div class="nk-notification-item dropdown-inner">
                                <div class="nk-notification-content">
                                    <div class="nk-notification-text">${item.message}</div>
                                    <div class="nk-notification-time">${item.created_at_f}</div>
                                </div>
                            </div>
                        `;
                    });
                    $('.notif-container').html(notifContent);
                }else {
                    $('.icon-notif').removeClass('icon-status icon-status-info');
                }
            }

            if (item == 'config') {
                let configKeys = Object.keys(response[item]);
                configKeys.map((itemConfig, indexConfig) => {
                    $(`.${itemConfig}`).html(response[item][itemConfig]);
                })
            }
        })
    }

    function getMasterDailyChallenge() {
        $.ajax({
            url      : '{{ route('daily.list') }}',
            dataType : 'jSON',
            success  : function (r) {
                let option = '<option value="">Select Type</option>';
                r.data.map((item, index) => {
                    option += `<option value="${item.id}" input-type="${item.isText}" rt="${item.point}" rt_f="${item.point_f}">${item.name}</option>`;
                })
                $('.master_daily_challenge').html(option);
            }
        })
    }

    function getAddress() {
        $.ajax({
            url      : '{{ route('wallet.address.get') }}',
            data     : {
                user_id : '{{ Auth::user()->id }}'
            },
            dataType : 'jSON',
            success  : function(r) {
                if (typeof r != 'string') {
                    // alert
                    $('.warning_address').attr('hidden', false);
                    $('.btn-withdraw').attr('disabled', true);
                }else {
                    $('input[name="address"]').val(r);
                }

            }
        })
    }
</script>
