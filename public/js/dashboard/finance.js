document.addEventListener('DOMContentLoaded', () => {
    const revenueByMonth = window.financeData?.revenueByMonth || [];
    const revenueByType = window.financeData?.revenueByType || [];
    const expensesByCategory = window.financeData?.expensesByCategory || [];

    let resizeTimer;

    function getResponsiveHeight() {
        const width = window.innerWidth;
        if (width < 576) return 200;
        if (width < 768) return 250;
        if (width < 1024) return 280;
        if (width < 1920) return 300;
        return 350;
    }

    const trendRT = document.querySelector('#revenueTrendChart');
    const hasTrendRt = Array.isArray(revenueByMonth) && revenueByMonth.length > 0;

    if (!trendRT || !hasTrendRt) {
        if (trendRT) trendRT.remove();
    } else {
        const months = revenueByMonth.map(d => d.month ?? '');
        const revenue = revenueByMonth.map(d => Number(d.revenue ?? d.amount ?? 0));

        const revenueTrendOptions = {
            series: [{
                name: "Revenue",
                data: revenue
            }],
            chart: {
                type: 'line',
                height: getResponsiveHeight(),
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                        selection: false,
                        zoom: false,
                        zoomin: false,
                        zoomout: false,
                        pan: false,
                        reset: false
                    }
                }
            },
            dataLabels: {
                enabled: window.innerWidth > 768
            },
            stroke: {
                curve: "smooth",
                width: 3
            },
            xaxis: {
                categories: months,
                labels: {
                    rotate: window.innerWidth < 768 ? -45 : 0,
                    style: {
                        fontSize: window.innerWidth < 768 ? '10px' : '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: val => "₱" + (val / 1000).toFixed(0) + "k",
                    style: {
                        fontSize: window.innerWidth < 768 ? '10px' : '12px'
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: val => "₱" + Number(val).toLocaleString()
                }
            },
            markers: {
                size: window.innerWidth < 768 ? 3 : 5,
                hover: {
                    size: window.innerWidth < 768 ? 5 : 7
                }
            },
            legend: {
                position: "top",
                horizontalAlign: "right",
                fontSize: window.innerWidth < 768 ? '11px' : '13px'
            }
        };

        const trendChart = new ApexCharts(trendRT, revenueTrendOptions);
        trendChart.render();

        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                trendChart.updateOptions({
                    chart: { height: getResponsiveHeight() },
                    dataLabels: { enabled: window.innerWidth > 768 },
                    xaxis: {
                        labels: {
                            rotate: window.innerWidth < 768 ? -45 : 0,
                            style: { fontSize: window.innerWidth < 768 ? '10px' : '12px' }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: { fontSize: window.innerWidth < 768 ? '10px' : '12px' }
                        }
                    },
                    markers: {
                        size: window.innerWidth < 768 ? 3 : 5,
                        hover: { size: window.innerWidth < 768 ? 5 : 7 }
                    },
                    legend: { fontSize: window.innerWidth < 768 ? '11px' : '13px' }
                });
            }, 250);
        });
    }

    const chartEl = document.querySelector("#expenseCategoryChart");
    const hasExpenseData = Array.isArray(expensesByCategory) && expensesByCategory.length > 0;

    if (!chartEl || !hasExpenseData) {
        if (chartEl) chartEl.remove();
    } else {
        const expenseCategoryOptions = {
            series: expensesByCategory.map(d => Number(d.amount || 0)),
            labels: expensesByCategory.map(d => d.category || 'N/A'),
            chart: {
                type: "pie",
                height: getResponsiveHeight(),
                toolbar: { show: true }
            },
            dataLabels: {
                enabled: true,
                style: { fontSize: window.innerWidth < 768 ? '10px' : '12px' }
            },
            legend: {
                show: true,
                position: window.innerWidth < 768 ? 'bottom' : 'right',
                fontSize: window.innerWidth < 768 ? '10px' : '12px'
            },
            tooltip: {
                y: { formatter: val => "₱" + Number(val).toLocaleString() }
            }
        };

        const expenseChart = new ApexCharts(chartEl, expenseCategoryOptions);
        expenseChart.render();

        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                expenseChart.updateOptions({
                    chart: { height: getResponsiveHeight() },
                    dataLabels: {
                        style: { fontSize: window.innerWidth < 768 ? '10px' : '12px' }
                    },
                    legend: {
                        position: window.innerWidth < 768 ? 'bottom' : 'right',
                        fontSize: window.innerWidth < 768 ? '10px' : '12px'
                    }
                });
            }, 250);
        });
    }

    const chartRt = document.querySelector('#revenueTypeChart');
    const hasRevenueType = Array.isArray(revenueByType) && revenueByType.length > 0;

    if (!chartRt || !hasRevenueType) {
        if (chartRt) chartRt.remove();
    } else {
        const revenueTypeOptions = {
            series: revenueByType.map(d => Number(d.amount || 0)),
            labels: revenueByType.map(d => d.type || 'N/A'),
            chart: {
                type: 'pie',
                height: getResponsiveHeight(),
                toolbar: { show: false }
            },
            dataLabels: {
                enabled: true,
                style: { fontSize: window.innerWidth < 768 ? '10px' : '12px' }
            },
            legend: {
                show: true,
                position: window.innerWidth < 768 ? 'bottom' : 'right',
                fontSize: window.innerWidth < 768 ? '10px' : '12px'
            },
            tooltip: {
                y: { formatter: val => "₱" + Number(val).toLocaleString() }
            }
        };

        const revenueChart = new ApexCharts(chartRt, revenueTypeOptions);
        revenueChart.render();

        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                revenueChart.updateOptions({
                    chart: { height: getResponsiveHeight() },
                    dataLabels: {
                        style: { fontSize: window.innerWidth < 768 ? '10px' : '12px' }
                    },
                    legend: {
                        position: window.innerWidth < 768 ? 'bottom' : 'right',
                        fontSize: window.innerWidth < 768 ? '10px' : '12px'
                    }
                });
            }, 250);
        });
    }

    const revExpEl = document.querySelector("#revenueVsExpenseChart");
    const hasRevExp = Array.isArray(revenueByMonth) && revenueByMonth.length > 0;

    if (!revExpEl || !hasRevExp) {
        if (revExpEl) revExpEl.remove();
    } else {
        const rev = revenueByMonth.map(d => Number(d.revenue || d.amount || 0));
        const exp = revenueByMonth.map(d => Number(d.expenses || 0));
        const months = revenueByMonth.map(d => d.month);

        const revenueVsExpenseOptions = {
            series: [{
                name: "Revenue",
                data: rev
            }, {
                name: "Expenses",
                data: exp
            }],
            chart: {
                type: "bar",
                height: getResponsiveHeight() + 50,
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    borderRadius: 6,
                    columnWidth: window.innerWidth < 768 ? "75%" : "60%"
                }
            },
            dataLabels: { enabled: false },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"]
            },
            xaxis: {
                categories: months,
                labels: {
                    rotate: window.innerWidth < 768 ? -45 : 0,
                    style: { fontSize: window.innerWidth < 768 ? '10px' : '12px' }
                }
            },
            yaxis: {
                labels: {
                    formatter: val => "₱" + (val / 1000).toFixed(0) + "k",
                    style: { fontSize: window.innerWidth < 768 ? '10px' : '12px' }
                }
            },
            tooltip: {
                y: { formatter: val => "₱" + Number(val).toLocaleString() }
            },
            legend: {
                position: "top",
                fontSize: window.innerWidth < 768 ? '11px' : '13px'
            }
        };

        const revExpChart = new ApexCharts(revExpEl, revenueVsExpenseOptions);
        revExpChart.render();

        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                revExpChart.updateOptions({
                    chart: { height: getResponsiveHeight() + 50 },
                    plotOptions: {
                        bar: { columnWidth: window.innerWidth < 768 ? "75%" : "60%" }
                    },
                    xaxis: {
                        labels: {
                            rotate: window.innerWidth < 768 ? -45 : 0,
                            style: { fontSize: window.innerWidth < 768 ? '10px' : '12px' }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: { fontSize: window.innerWidth < 768 ? '10px' : '12px' }
                        }
                    },
                    legend: { fontSize: window.innerWidth < 768 ? '11px' : '13px' }
                });
            }, 250);
        });
    }
});
