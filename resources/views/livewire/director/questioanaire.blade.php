<div>
    @isset($surveyQuestions)
        @foreach($surveyQuestions as $index => $question)
            <div class="chart-container mb-8">
                <h3 class="text-lg font-semibold mb-2">
                    {{ 'SQD' . ($index + 1) }}: {{ $question->question }}
                </h3>
                <canvas id="chart-{{ $question->id }}" height="100"></canvas>
            </div>
        @endforeach
    @else
        <p class="text-red-500">No survey questions found.</p>
    @endisset
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @isset($surveyQuestions)
            const surveyQuestions = @json($surveyQuestions);
            const ratingsData = @json($ratingsData ?? []);

            surveyQuestions.forEach(question => {
                const ctx = document.getElementById(`chart-${question.id}`)?.getContext('2d');

                if (ctx && ratingsData[question.id]) {
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [
                                'Strongly Disagree',
                                'Disagree',
                                'Neutral',
                                'Agree',
                                'Strongly Agree',
                                'N/A'
                            ],
                            datasets: [{
                                label: 'Response Count',
                                data: [
                                    ratingsData[question.id].sd_count || 0,
                                    ratingsData[question.id].d_count || 0,
                                    ratingsData[question.id].nad_count || 0,
                                    ratingsData[question.id].a_count || 0,
                                    ratingsData[question.id].sa_count || 0,
                                    ratingsData[question.id].na_count || 0
                                ],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(255, 159, 64, 0.7)',
                                    'rgba(255, 205, 86, 0.7)',
                                    'rgba(75, 192, 192, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(153, 102, 255, 0.7)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 205, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(153, 102, 255, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            }
                        }
                    });
                }
            });
        @endisset
    });
</script>