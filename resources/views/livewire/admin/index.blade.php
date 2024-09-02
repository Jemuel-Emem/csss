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
                    labels: @json(array_values($categoryLabels)),
                    datasets: [{
                        label: 'Number of Responses',
                        data: @json(array_values($totals)),
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
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
                plugins: [{
                    id: 'customImagePlugin',
                    beforeDraw: (chart) => {
                        const ctx = chart.ctx;
                        const data = chart.data.datasets[0].data;
                        const labels = chart.data.labels;

                        const images = {
                            'Very Satisfied': '{{ asset('images/approve.png') }}',
                            'Satisfied': '{{ asset('images/happy.png') }}',
                            'Neither Satisfied nor Dissatisfied': '{{ asset('images/wondering.png') }}',
                            'Dissatisfied': '{{ asset('images/wow.png') }}',
                            'Not Applicable': '{{ asset('images/sad.png') }}'
                        };

                        data.forEach((value, index) => {
                            const label = labels[index];
                            const image = new Image();
                            image.src = images[label];


                            ctx.drawImage(image, chart.getDatasetMeta(0).data[index].x - 12, chart.getDatasetMeta(0).data[index].y - 12, 24, 24);
                        });
                    }
                }]
            });
        });
    </script>
</div>
