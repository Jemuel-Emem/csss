<div class="flex flex-col items-center p-6 bg-white shadow-lg rounded-lg w-7xl  mx-auto">

    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-700">Survey Interpretation</h2>
        <h2 class="text-lg font-bold text-gray-700">Overall Satisfaction Score:</h2> <p class="text-2xl font-bold text-blue-500">{{ number_format($overallScore, 2) }}%</p>
        <p class="text-lg mt-2">
            Overall Rating:
            <span class="
                @if($overallScore < 60) text-red-600 font-bold
                @elseif($overallScore >= 60 && $overallScore <= 79.9) text-orange-500 font-bold
                @elseif($overallScore >= 80 && $overallScore <= 89.9) text-yellow-500 font-bold
                @elseif($overallScore >= 90 && $overallScore <= 94.9) text-green-500 font-bold
                @elseif($overallScore >= 95) text-green-700 font-bold
                @endif
            ">
                {{ $interpretation }}
            </span>
        </p>
    </div>

    <!-- Chart Container (Increased Size) -->
    <div class="relative flex justify-center items-center w-full max-w-7xl bg-gray-100 rounded-lg shadow-md p-6">
        <canvas id="surveyChart" class="w-full h-auto" style="max-width: 2000px; height: 1000px;"></canvas>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('surveyChart').getContext('2d');

        const chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json(array_keys($percentages)), // Rating categories
                datasets: [{
                    label: 'Percentage (%)',
                    data: @json(array_values($percentages)), // Percentage values
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',   // Strongly Agree
                        'rgba(54, 162, 235, 0.6)',   // Agree
                        'rgba(255, 206, 86, 0.6)',   // Neither Agree nor Disagree
                        'rgba(255, 99, 132, 0.6)',   // Disagree
                        'rgba(153, 102, 255, 0.6)',  // Strongly Disagree
                        'rgba(201, 203, 207, 0.6)'   // Not Applicable
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(201, 203, 207, 1)'
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
                            font: {
                                size: 14
                            },
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
</script>
