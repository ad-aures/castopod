import Choices from "choices.js";

const MultiSelect = (): void => {
  // Pass single element
  const multiSelects: NodeListOf<HTMLSelectElement> = document.querySelectorAll(
    "select[multiple]"
  );

  for (let i = 0; i < multiSelects.length; i++) {
    const multiSelect = multiSelects[i];

    new Choices(multiSelect, {
      maxItemCount: parseInt(multiSelect.dataset.maxItemCount || "-1"),
      itemSelectText: multiSelect.dataset.selectText,
      maxItemText: multiSelect.dataset.maxItemText,
      removeItemButton: true,
      classNames: {
        containerOuter:
          "multiselect" +
          (multiSelect.dataset.class ? ` ${multiSelect.dataset.class}` : ""),
        containerInner: "multiselect__inner",
        input: "multiselect__input",
        inputCloned: "multiselect__input--cloned",
        list: "multiselect__list",
        listItems: "multiselect__list--multiple",
        listSingle: "multiselect__list--single",
        listDropdown: "multiselect__list--dropdown",
        item: "multiselect__item",
        itemSelectable: "multiselect__item--selectable",
        itemDisabled: "multiselect__item--disabled",
        itemChoice: "multiselect__item--choice",
        placeholder: "multiselect__placeholder",
        group: "multiselect__group",
        groupHeading: "multiselect__heading",
        button: "multiselect__button",
        activeState: "is-active",
        focusState: "is-focused",
        openState: "is-open",
        disabledState: "is-disabled",
        highlightedState: "is-highlighted",
        selectedState: "is-selected",
        flippedState: "is-flipped",
        loadingState: "is-loading",
        noResults: "has-no-results",
        noChoices: "has-no-choices",
      },
    });
  }
};

export default MultiSelect;
