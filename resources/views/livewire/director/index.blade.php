<div class="flex flex-col items-center p-6 bg-white shadow-lg rounded-lg w-7xl mx-auto">

    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-700">Survey Interpretation</h2>
    </div>

    <!-- Daily, Weekly, and Yearly Sections -->
    @foreach (['daily' => $dailyData, 'weekly' => $weeklyData, 'monthly' => $monthlyData, 'yearly' => $yearlyData] as $label => $data)

        <div class="w-full max-w-7xl bg-gray-100 rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-700 capitalize">{{ $label }} Survey Results</h3>

            <p class="text-lg mt-2">
                Overall Satisfaction Score:
                <span class="text-2xl font-bold text-blue-500">
                    {{ number_format($data['score'], 2) }}%
                </span>
            </p>

            <p class="text-lg">
                Overall Rating:
                <span class="
                    @if($data['score'] < 60) text-red-600 font-bold
                    @elseif($data['score'] >= 60 && $data['score'] <= 79.9) text-orange-500 font-bold
                    @elseif($data['score'] >= 80 && $data['score'] <= 89.9) text-yellow-500 font-bold
                    @elseif($data['score'] >= 90 && $data['score'] <= 94.9) text-green-500 font-bold
                    @elseif($data['score'] >= 95) text-green-700 font-bold
                    @endif
                ">
                    {{ $data['interpretation'] }}
                </span>
            </p>

            <!-- Chart -->
            <div class="relative flex justify-center items-center w-full max-w-7xl bg-white rounded-lg shadow-md p-6">
                <canvas id="surveyChart_{{ $label }}"></canvas>
            </div>
        </div>
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartData = @json(['daily' => $dailyData['percentages'], 'weekly' => $weeklyData['percentages'], 'yearly' => $yearlyData['percentages']]);

        Object.keys(chartData).forEach((label) => {
            const ctx = document.getElementById(`surveyChart_${label}`).getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: Object.keys(chartData[label]),
                    datasets: [{
                        label: 'Percentage (%)',
                        data: Object.values(chartData[label]),
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(201, 203, 207, 0.6)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { size: 14 },
                                color: '#555'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';
                                }
                            }
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        });
    });
</script>
