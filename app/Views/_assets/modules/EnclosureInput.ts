const EnclosureInput = (): void => {
  const enclosureInput = document.querySelector(
    ".form-enclosure-input"
  ) as HTMLInputElement;

  if (enclosureInput) {
    const label = enclosureInput?.nextElementSibling?.querySelector(
      "span"
    ) as HTMLSpanElement;
    const labelVal = label.innerHTML;

    enclosureInput.addEventListener("change", (e: Event) => {
      const fileName = (e.target as HTMLInputElement).value.split("\\").pop();

      if (fileName) {
        label.innerHTML = fileName;
      } else {
        label.innerHTML = labelVal;
      }
    });
  }
};

export default EnclosureInput;
