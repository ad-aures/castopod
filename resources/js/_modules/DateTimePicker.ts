import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import "flatpickr/dist/themes/material_green.css";

/*
 * Detects navigator locale 24h time preference
 * It works by checking whether hour output contains AM ('1 AM' or '01 h')
 */
const isBrowserLocale24h = () =>
  !new Intl.DateTimeFormat(navigator.language, { hour: "numeric" })
    .format(0)
    .match(/AM/);

const DateTimePicker = (): void => {
  const dateTimeContainers: NodeListOf<HTMLDivElement> =
    document.querySelectorAll("div[data-picker='datetime']");

  for (let i = 0; i < dateTimeContainers.length; i++) {
    const dateTimeContainer = dateTimeContainers[i];
    const dateTimeInput: HTMLInputElement | null =
      dateTimeContainer.querySelector("input[data-input]");

    if (dateTimeInput) {
      const flatpickrInstance = flatpickr(dateTimeContainer, {
        enableTime: true,
        time_24hr: isBrowserLocale24h(),
        wrap: true,
      });

      // convert container UTC date value to user timezone
      const dateTime = new Date(dateTimeInput.value);
      const dateUTC = Date.UTC(
        dateTime.getFullYear(),
        dateTime.getMonth(),
        dateTime.getDate(),
        dateTime.getHours(),
        dateTime.getMinutes()
      );

      // set converted date as field value
      flatpickrInstance.setDate(new Date(dateUTC));
    }
  }
};

export default DateTimePicker;
