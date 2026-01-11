import Chart from "chart.js/auto";

/*--------------------------------------------------------------
| Analytic Chart Initialization
--------------------------------------------------------------*/
function analyticChart() {
    const chartEl = document.getElementById("analytic-chart");
    
    if (!chartEl) {
        return;
    }

    const ctx = chartEl.getContext("2d");

    // Gradient fill
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, "rgba(157,216,212,0.45)");
    gradient.addColorStop(1, "rgba(157,216,212,0.06)");

    // Chart configuration
    const config = {
        type: "line",
        data: {
            labels: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            datasets: [
                {
                    label: "Revenue",
                    data: [12, 19, 15, 22, 30, 28, 35, 42, 38, 45, 50, 58],
                    borderColor: "#6fe0d9",
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.35,
                    pointRadius: 2.5,
                    pointBackgroundColor: "#6fe0d9",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: { display: false },
                tooltip: { mode: "index", intersect: false },
                datalabels: { display: false },
                colors: { enabled: true },
            },

            scales: {
                x: {
                    grid: { color: "rgba(41,41,41,0.2)" },
                    ticks: { color: "#D1D5DB" },
                },
                y: {
                    grid: { color: "rgba(41,41,41,0.2)" },
                    ticks: { color: "#D1D5DB" },
                },
            },

            elements: {
                point: {
                    radius: 2.5,
                    hoverRadius: 5,
                    display: true,
                },
            },
        },
    };

    // Create chart
    let chart = new Chart(ctx, config);

    // Recreate on resize
    window.addEventListener("resize", () => {
        if (chart) {
            chart.destroy();
        }
        chart = new Chart(ctx, config);
    });
}

document.addEventListener("DOMContentLoaded", analyticChart);
