<div class="pb-[10px] bg-[#DDD] min-h-[calc(50vh-46px)] flex items-center"
x-data="{
    ident: 'chart1',
    data: $wire.entangle('data.chart1'),
    labels: $wire.entangle('labels.chart1'),
    chart: null,

    init() {
        let elementId = $wire.chartId[this.ident];
        let el = document.getElementById(elementId);
        this.chart = this.newchart(el, this.labels, this.data);
    },

    changechart() {
        if (this.chart) {
            this.chart.destroy();
        }

        $wire.chartchange().then(() => {
            let el = document.getElementById($wire.chartId[this.ident]);
            this.chart = this.newchart(el, this.labels, this.data);
        });
    },

    newchart(element, labels, data) {
        return new Chart(element, {
            type: $wire.chartType[this.ident],
            data: {
                labels: labels,
                datasets: [{
                    label: $wire.label[this.ident],
                    data: data,
                    backgroundColor: [...$wire.backgroundColor[this.ident]],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    }

}">
    <div class="w-full">
        <div style="position: relative;width: 100%;padding-top: 85%;">
            <div style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;max-height: none;">
                <canvas wire:ignore id="chart1"></canvas>
            </div>
        </div>

        <div class="text-center mt-[10px]">
            <button @click="changechart()" class="border-[1px] border-black p-[8px]">
                Update
            </button>
        </div>
    </div>
</div>
