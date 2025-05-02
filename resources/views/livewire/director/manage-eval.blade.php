<div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <canvas id="officeChart" class="w-full h-96"></canvas>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('officeChart').getContext('2d');

        // Data from Livewire
        const officeLabels = @json($officeLabels);
        const scoreValues = @json($scoreValues);
        const interpretations = @json($interpretations);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: officeLabels,
                datasets: [{
                    label: 'Satisfaction Score (%)',
                    data: scoreValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: value => value + '%'
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                // Get the current label (office name)
                                const officeName = context.label;
                                // Get the score
                                const score = context.raw;
                                // Get the interpretation using the office name as key
                                const interpretation = interpretations[officeName] || 'No interpretation';
                                return `${score}% - ${interpretation}`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
