<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="{{ asset('account/assets/js/bundle.js?ver=3.0.2') }}"></script>
<script src="{{ asset('account/assets/js/scripts.js?ver=3.0.2') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'Authorization': 'Bearer {{ Auth::user()->web_token }}'
        }
    });
</script>
<script src="https://cdn3.devexpress.com/jslib/17.1.6/js/dx.all.js"></script>

<script>
    $(function() {

        class GaugeChart {
            constructor(element, params) {
                this._element = element;
                this._initialValue = params.initialValue;
                this._higherValue = params.higherValue;
                this._title = params.title;
                this._subtitle = params.subtitle;
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
                        let currentGauge = $(element);
                        let circle = currentGauge.find('.dxg-spindle-hole').clone();
                        let border = currentGauge.find('.dxg-spindle-border').clone();

                        currentGauge.find('.dxg-title text').first().attr('y', 48);
                        currentGauge.find('.dxg-title text').last().attr('y', 28);
                        currentGauge.find('.dxg-value-indicator').append(border, circle);
                    }
                };
            }

            init() {
                $(this._element).dxCircularGauge(this._buildConfig());
            }
        }


        $(document).ready(function() {

            $('.gauge').each(function(index, item) {
                let num = getRandomArbitrary(10, 99);
                let params = {
                    initialValue: num,
                    higherValue: 100,
                    title: 'Progress',
                    subtitle: `${parseInt(num)}%`
                };
                let gauge = new GaugeChart(item, params);
                gauge.init();
            });

        });
    });

    function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
    }
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
            if (item == 'id') {

            } else {
                $(`input[name="${item}"]`).val(response[item]);
                $(`textarea[name="${item}"]`).val(response[item]);
            }
        })
    }
</script>