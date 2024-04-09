// Variables
const range1 = document.querySelector("#dateRange1");
const range2 = document.querySelector("#dateRange2");
const clearBtn = document.querySelector("#dateClear");
const today = new Date();
const maxDate = new Date(new Date().setMonth(new Date().getMonth() + 1));
let dateRangePicker;
let datePicker;

// Date Range Picker
try {
	dateRangePicker = flatpickr(document.querySelector("#dateRange1"), {
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
		disable: [],
		// plugins
		plugins: [
			new rangePlugin({
				input: document.querySelector("#dateRange2"),
			}),
		],
	});
} catch (error) {
	// Handle the error
	console.error("Error initializing date range picker:", error.message);
}

// Single Date Picker
try {
	datePicker = flatpickr(document.querySelector("#startDate"), {
		enableTime: false,
		disableMobile: true,
		dateFormat: "D d F",
		minDate: "today",
		maxDate: maxDate,
		locale: {
			firstDayOfWeek: 1,
		},
	});
} catch (error) {
	// Handle the error
	console.error("Error initializing date picker:", error.message);
}

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

	// Change clearBtn
	clearBtn.type = "reset";
}

// Clear Input
clearBtn.onclick = () => {
	if (dateRangePicker) {
		dateRangePicker.clear();
	}
	if (datePicker) {
		datePicker.clear();
	}
};
