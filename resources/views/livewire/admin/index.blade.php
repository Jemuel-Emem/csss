<div>
    <div>
        <div class="mt-8">
            <h2 class="text-lg font-bold">Survey Results Chart</h2>
            <canvas id="surveyChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('surveyChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json(array_values($categoryLabels)), // Chart labels
                    datasets: [{
                        label: 'Percentage  (%)', // Updated label
                        data: @json(array_values($percentages)), // Use percentages here
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        datalabels: {
                            display: false // Disable data labels if you don't want them
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value + '%'; // Display percentage symbol
                                }
                            }
                        }
                    }
                },
                plugins: [{
                    id: 'customImagePlugin',
                    beforeDraw: (chart) => {
                        const ctx = chart.ctx;
                        const dataset = chart.getDatasetMeta(0);
                        const images = {
                            'Very Satisfied': '{{ asset('images/approve.png') }}',
                            'Satisfied': '{{ asset('images/happy.png') }}',
                            'Neither Satisfied nor Dissatisfied': '{{ asset('images/wondering.png') }}',
                            'Dissatisfied': '{{ asset('images/wow.png') }}',
                            'Not Applicable': '{{ asset('images/sad.png') }}'
                        };

                        dataset.data.forEach((bar, index) => {
                            const label = chart.data.labels[index];
                            const imageSrc = images[label];
                            const image = new Image();
                            image.src = imageSrc;

                            image.onload = function() {
                                const x = bar.x - 12; // Adjust position
                                const y = bar.y - 12; // Adjust position
                                ctx.drawImage(image, x, y, 24, 24);
                            };
                        });
                    }
                }]
            });
        });
    </script>
</div>
