// Variables
const range1 = document.querySelector("#dateRange1");
const range2 = document.querySelector("#dateRange2");
const clearBtn = document.querySelector("#dateRangeClear");
const today = new Date();
const maxDate = new Date(new Date().setMonth(new Date().getMonth() + 1));

// Date Range Picker
const dateRangePicker = flatpickr(range1, {
	mode: "range",
	enableTime: false,
	disableMobile: true,
	dateFormat: "D d F",
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
			input: range2,
		}),
	],
});

// Disable Flatpickr if device width is too short
if (window.innerWidth < 618) {
	flatpickr("#dateRange1").destroy();

	// enable date picker for date range 1
	range1.type = "date";
	range1.setAttribute("min", today.toISOString().split("T")[0]);
	range1.setAttribute("max", maxDate.toISOString().split("T")[0]);

	// enable date picker for date range 2
	range2.type = "date";
	range2.removeAttribute("readonly");
	range2.setAttribute("min", today.toISOString().split("T")[0]);
	range2.setAttribute("max", maxDate.toISOString().split("T")[0]);
}

// Clear Input
clearBtn.onclick = () => {
	dateRangePicker.clear();
};
