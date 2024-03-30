// Variables
const today = new Date();
const maxDate = new Date().setMonth(new Date().getMonth() + 1);

// Date Range Picker
const dateRangePicker = flatpickr("#dateRange1", {
	mode: "range",
	enableTime: false,
	dateFormat: "Y-m-d",
	minDate: "today",
	maxDate: maxDate,
	showMonths: 2,
	locale: {
		firstDayOfWeek: 1,
	},
	// disable dates
	disable: [
		{
			from: "2024-09-01",
			to: "2024-12-01",
		},
		// "2024-04-20",
		// (date) => date.getDay() % 6 === 0,
	],
	// plugins
	plugins: [
		new rangePlugin({
			input: "#dateRange2",
		}),
	],
});

// Clear Date Range
document.querySelector("#dateRangeClear").onclick = () => {
	dateRangePicker.clear(); // Clear range inputs
};
