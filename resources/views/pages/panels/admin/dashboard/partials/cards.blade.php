<div class="dashboard-cards">
    @foreach ($dashboardData['cards'] as $index => $card)
        <div
            class="dashboard-card"
            data-aos="fade-up"
        >
            <div class="dashboard-card-icon">
                <i class="{{ $card['icon'] }}"></i>
            </div>
            <div class="dashboard-card-content">
                <div>
                    <h4>{{ $card['title'] }}</h4>
                    <div class="dashboard-card-value">{{ $card['value'] }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
