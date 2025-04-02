<div class="flex flex-col items-center p-6 bg-white shadow-lg rounded-lg w-full mx-auto">

    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-700">Survey Demographics</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
        <!-- Gender Chart -->
        <div class="p-4 bg-gray-100 shadow rounded-lg">
            <h3 class="text-lg font-bold text-center mb-2">By Gender</h3>
            <canvas id="genderChart"></canvas>
        </div>

        <!-- Client Type Chart -->
        <div class="p-4 bg-gray-100 shadow rounded-lg">
            <h3 class="text-lg font-bold text-center mb-2">By Client Type</h3>
            <canvas id="clientTypeChart"></canvas>
        </div>

        <!-- Age Group Chart -->
        <div class="p-4 bg-gray-100 shadow rounded-lg">
            <h3 class="text-lg font-bold text-center mb-2">By Age Group</h3>
            <canvas id="ageChart"></canvas>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Gender Chart
        new Chart(document.getElementById('genderChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: @json(array_keys($genderData)),
                datasets: [{
                    data: @json(array_values($genderData)),
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    borderWidth: 1
                }]
            }
        });

        // Client Type Chart
        new Chart(document.getElementById('clientTypeChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: @json(array_keys($clientTypeData)),
                datasets: [{
                    data: @json(array_values($clientTypeData)),
                    backgroundColor: ['#4CAF50', '#FFC107', '#FF5722'],
                    borderWidth: 1
                }]
            }
        });

        // Age Group Chart
        new Chart(document.getElementById('ageChart').getContext('2d'), {
            type: 'pie',
            data: {
                labels: @json(array_keys($ageGroupData)),
                datasets: [{
                    data: @json(array_values($ageGroupData)),
                    backgroundColor: ['#8E44AD', '#2980B9', '#27AE60', '#D35400'],
                    borderWidth: 1
                }]
            }
        });
    });
</script>
