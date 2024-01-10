

<?php $__env->startSection('element'); ?>
    <div class="row">
        <div class="col-12">
            <div class="row">
                
                <div class="col-lg-3 col-sm-6 col-3 mb-4">
                    <div class="sp-widget-1 bg-white rounded-xl link-item widget-hr-effect">
                        <a href="<?php echo e(route('admin.user.index')); ?>" class="link"></a>
                        <div class="widget-icon light-icon-1">
                            <i class="las la-users"></i>
                        </div>
                        <div class="widget-content">
                            <div class="widget-caption text-dark"><?php echo e(__('Total Accounts')); ?></div>
                            <h3 class="mb-0 mt-1 widget-title text-dark"><?php echo e($totalAccounts); ?></h3>
                        </div>
                    </div>
                </div>
                
                


                <div class="col-lg-3 col-sm-6 col-3 mb-4">
                    <div class="sp-widget-1 bg-white rounded-xl link-item widget-hr-effect">
                        <a href="<?php echo e(route('admin.user.index')); ?>" class="link"></a>
                        <div class="widget-icon light-icon-1">
                            <i class="las la-user"></i>
                        </div>
                        <div class="widget-content">
                            <div class="widget-caption text-dark"><?php echo e(__('Total Deposits')); ?></div>
                            <h3 class="mb-0 mt-1 widget-title text-dark"><?php echo e(Config::formatter($totalDeposit)); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-3 mb-4">
                    <div class="sp-widget-1 bg-white rounded-xl link-item widget-hr-effect">
                        <a href="<?php echo e(route('admin.user.index')); ?>" class="link"></a>
                        <div class="widget-icon light-icon-1">
                            <i class="las la-dollar-sign"></i>
                        </div>
                        <div class="widget-content">
                            <div class="widget-caption text-dark"><?php echo e(__('Total user')); ?></div>
                            <h3 class="mb-0 mt-1 widget-title text-dark"><?php echo e($totalUser); ?></h3>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-sm-6 col-3 mb-4">
                    <div class="sp-widget-1 bg-white rounded-xl link-item widget-hr-effect">
                        <a href="<?php echo e(route('admin.ticket.index')); ?>" class="link"></a>
                        <div class="widget-icon light-icon-3">
                            <i class="las la-folder"></i>
                        </div>
                        <div class="widget-content">
                            <div class="widget-caption text-dark"><?php echo e(__('Total Ticket')); ?></div>
                            <h3 class="mb-0 mt-1 widget-title text-dark"><?php echo e($totalTicket); ?></h3>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
        
        
        
        
        
    </div>

    

    

      <div class="row">
        <div class="col-xxl-9 col-lg-8">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h4 class="card-title"><?php echo e(__('Latest Registerations')); ?></h4>
                    <a href="<?php echo e(route('admin.user.index')); ?>"
                        class="site-color fw-500"><?php echo e(__('View All')); ?></a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php $__empty_1 = true; $__currentLoopData = $latestUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        
                                        <td><?php echo e($user->username); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="100%" class="text-center"><?php echo e(__('No user Found')); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

     
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        'use strict'


        <?php if(now()->diffInMinutes(\Carbon\Carbon::parse(Config::config()->cron_run_time)) > 25): ?>

            $(function() {
                const modal = $('#cron')

                modal.modal('show')
            })


            var copyButton = document.querySelector('.copy');
            var copyInput = document.querySelector('.copy-text');
            copyButton.addEventListener('click', function(e) {
                e.preventDefault();
                var text = copyInput.select();
                document.execCommand('copy');
            });
            copyInput.addEventListener('click', function() {
                this.select();
            });
        <?php endif; ?>

        // User Statistics

        var user = {

            series: [<?php echo e($activeUser); ?>, <?php echo e($pendingUser); ?>, <?php echo e($emailUser); ?>],
            labels: ['Active', 'Deactive', 'Email Verified'],
            chart: {
                type: 'donut',
                width: 345,
                height: 393
            },
            colors: ['#622bd7', '#e2a03f', '#e7515a', '#e2a03f'],
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                labels: {
                    colors: '#777'
                },
                markers: {
                    width: 10,
                    height: 10,
                    offsetX: -5,
                    offsetY: 0
                },
                itemMargin: {
                    horizontal: 10,
                    vertical: 30
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '75%',
                        background: 'transparent',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '29px',
                                fontFamily: 'Nunito, sans-serif',
                                color: '#ffffff',
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '26px',
                                fontFamily: 'Nunito, sans-serif',
                                color: '#bfc9d4',
                                offsetY: 16,
                                formatter: function(val) {
                                    return val
                                }
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: 'Total',
                                color: '#777777',
                                fontSize: '30px',
                                formatter: function(w) {
                                    return "<?php echo e($totalUser); ?>"
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                show: true,
                width: 15,
                colors: '#ffffff'
            },
            responsive: [{
                breakpoint: 1400,
                options: {
                    chart: {
                        width: 300,
                        height: 315
                    }
                }
            }]
        };

        var chart2 = new ApexCharts(document.querySelector("#chart2"), user);
        chart2.render();

        var chart5 = new ApexCharts(document.querySelector("#chart5"), user);
        chart5.render();



        var payment = {
            series: [{
                    name: 'Payments',
                    data: <?php echo json_encode($totalAmount, 15, 512) ?>
                },
                {
                    name: 'Deposits',
                    data: <?php echo json_encode($depositsTotalAmount, 15, 512) ?>
                },
                {
                    name: 'Withdraw',
                    data: <?php echo json_encode($withdrawTotalAmount, 15, 512) ?>
                }
            ],
            labels: ['Payments', 'Deposits', 'Withdraw'],
            chart: {
                height: 300,
                type: 'area',
                dropShadow: {
                    enabled: true,
                    opacity: 0.2,
                    blur: 10,
                    left: -7,
                    top: 22
                },
                toolbar: {
                    show: false
                },
            },

            plotpayment: {
                bar: {
                    horizontal: false,
                    columnWidth: '40%',
                    endingShape: 'rounded'
                },
            },

            markers: {
                colors: ['#449ae7', '#449ae7', '#449ae7']
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                curve: 'smooth',
                width: 2,
                lineCap: 'square'
            },
            xaxis: {
                categories: <?php echo json_encode($months, 15, 512) ?>,
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    show: true
                },
                labels: {
                    offsetX: 0,
                    offsetY: 5,
                    style: {
                        fontSize: '12px',
                        cssClass: 'apexcharts-xaxis-title',
                    },
                }
            },
            yaxis: {
                labels: {
                    formatter: function(value, index) {
                        return (value / 1000) + 'K'
                    },
                    offsetX: -15,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        cssClass: 'apexcharts-yaxis-title',
                    },
                }
            },
            grid: {
                borderColor: '#d1d1d1',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false,
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 5
                },
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                fontSize: '14px',
                labels: {
                    colors: '#777'
                },
                markers: {
                    width: 10,
                    height: 10,
                    offsetX: -5,
                    offsetY: 0
                },
                itemMargin: {
                    horizontal: 10,
                    vertical: 30
                }
            },

            fill: {
                type: "gradient",
                gradient: {
                    type: "vertical",
                    shadeIntensity: 1,
                    inverseColors: !1,
                    opacityFrom: .19,
                    opacityTo: .05,
                    stops: [100, 100]
                }
            },
            responsive: [{
                breakpoint: 575,
                options: {
                    legend: {
                        offsetY: -50,
                    },
                },
            }],

            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };


        var chart = new ApexCharts(document.querySelector("#profit-chart"), payment);
        chart.render();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\personal\crypto-script\resources\views/backend/dashboard.blade.php ENDPATH**/ ?>