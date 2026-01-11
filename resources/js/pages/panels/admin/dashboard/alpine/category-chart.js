import Chart from "chart.js/auto";
import ChartDataLabels from "chartjs-plugin-datalabels";

Chart.register(ChartDataLabels);

function categoryChart() {
    const chartEl = document.getElementById("category-chart");
    if (!chartEl) {
        return;
    }

    const ctx = chartEl.getContext("2d");

    // Chart configuration
    const config = {
        type: "doughnut",
        data: {
            labels: ["Bedding", "Decor", "Bath", "Bundles"],
            datasets: [
                {
                    data: [45, 25, 15, 15],
                    backgroundColor: [
                        "#9DD8D4",
                        "rgba(157,216,212,0.6)",
                        "rgba(157,216,212,0.3)",
                        "rgba(157,216,212,0.15)",
                    ],
                    borderWidth: 0,
                    cutout: "60%",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: 25 },

            plugins: {
                legend: { display: false },
                tooltip: {
                    enabled: true,
                    backgroundColor: "#000",
                    titleColor: "#fff",
                    bodyColor: "#fff",
                },
                datalabels: {
                    formatter: (value, ctx) =>
                        ctx.chart.data.labels[ctx.dataIndex],
                    color: "#fff",
                    backgroundColor: (ctx) =>
                        ctx.dataset.backgroundColor[ctx.dataIndex],
                    borderRadius: 12,
                    padding: { top: 6, bottom: 6, left: 10, right: 10 },
                    font: {
                        weight: "600",
                        size: 12,
                    },
                    align: "center",
                    anchor: "center",
                    offset: 10,
                    clip: false,
                },
            },
        },
    };

    // Create the chart
    const chart = new Chart(ctx, config);

    // Proper responsive fix:
    const resizeObserver = new ResizeObserver(() => {
        chart.resize();
    });
    resizeObserver.observe(chartEl.parentElement);
}

document.addEventListener("DOMContentLoaded", categoryChart);
