import Tooltip from "./Tooltip";

const FieldArray = (): void => {
  const fieldArrays: NodeListOf<HTMLElement> =
    document.querySelectorAll("[data-field-array]");

  for (let i = 0; i < fieldArrays.length; i++) {
    const fieldArray = fieldArrays[i];
    const fieldArrayContainer = fieldArray.querySelector(
      "[data-field-array-container]"
    );
    const items: NodeListOf<HTMLElement> = fieldArray.querySelectorAll(
      "[data-field-array-item]"
    );
    const addButton = fieldArray.querySelector(
      "button[data-field-array-add]"
    ) as HTMLButtonElement;

    const deleteButtons: NodeListOf<HTMLButtonElement> =
      fieldArray.querySelectorAll("[data-field-array-delete]");

    deleteButtons.forEach((deleteBtn) => {
      deleteBtn.addEventListener("click", (e) => {
        e.preventDefault();
        deleteBtn.blur();
        fieldArrayContainer
          ?.querySelector(
            `[data-field-array-item="${deleteBtn.dataset.fieldArrayDelete}"]`
          )
          ?.remove();
      });
    });

    // create base element to clone
    const baseItem = items[0].cloneNode(true) as HTMLElement;

    const elements: NodeListOf<HTMLFormElement> = baseItem.querySelectorAll(
      "input, select, textarea"
    );

    elements.forEach((element) => {
      element.value = "";
    });

    if (fieldArrayContainer && addButton) {
      addButton.addEventListener("click", (event) => {
        event.preventDefault();

        const newItem = baseItem.cloneNode(true) as HTMLElement;

        const deleteBtn: HTMLButtonElement | null = newItem.querySelector(
          "button[data-field-array-delete]"
        );

        if (deleteBtn) {
          deleteBtn.addEventListener("click", () => {
            deleteBtn.blur();
            newItem.remove();
          });

          fieldArrayContainer.appendChild(newItem);
          newItem.scrollIntoView({
            behavior: "auto",
            block: "center",
            inline: "center",
          });

          // reload tooltip module for showing remove button label
          Tooltip();

          // focus to first form element if mouse click
          if (event.screenX !== 0 && event.screenY !== 0) {
            const elements: NodeListOf<HTMLFormElement> =
              newItem.querySelectorAll("input, select, textarea");

            if (elements.length > 0) {
              elements[0].focus();
            }
          }
        }
      });

      const updateIndexes = () => {
        // get last child item to set item count
        const items: NodeListOf<HTMLElement> =
          fieldArrayContainer.querySelectorAll("[data-field-array-item]");

        let itemIndex = 0;
        items.forEach((item) => {
          const itemNumber: HTMLElement | null = item.querySelector(
            "[data-field-array-number]"
          );

          if (itemNumber) {
            itemNumber.innerHTML = "#";
            const indexNum = itemIndex + 1;
            if (item.dataset.fieldArrayItem !== itemIndex.toString()) {
              item.classList.add("motion-safe:animate-single-pulse");
              setTimeout(() => {
                item.classList.remove("motion-safe:animate-single-pulse");
                itemNumber.innerHTML = indexNum.toString();
              }, 300);
            } else {
              itemNumber.innerHTML = indexNum.toString();
            }
          }

          item.dataset.fieldArrayItem = itemIndex.toString();
          const deleteBtn = item.querySelector(
            "button[data-field-array-delete]"
          ) as HTMLButtonElement | null;

          if (deleteBtn) {
            deleteBtn.dataset.fieldArrayDelete = itemIndex.toString();
          }

          const itemElements: NodeListOf<HTMLFormElement> =
            item.querySelectorAll("input, select, textarea");

          itemElements.forEach((element) => {
            const label: HTMLLabelElement | null = item.querySelector(
              `label[for="${element.id}"]`
            );

            const elementID = element.name.replace(
              /(.*\[)\d+?(\].*)/g,
              `$1${itemIndex}$2`
            );

            if (label) {
              label.htmlFor = elementID;
            }

            element.id = elementID;
            element.name = elementID;
          });

          itemIndex++;
        });
      };

      // add mutation observer to run index updates when field array
      // items are added or removed
      const callback = function (mutationList: MutationRecord[]) {
        for (const mutation of mutationList) {
          if (mutation.type === "childList") {
            updateIndexes();
          }
        }
      };

      const observer = new MutationObserver(callback);

      observer.observe(fieldArrayContainer, { childList: true });
    }
  }
};

export default FieldArray;
