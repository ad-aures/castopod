import Choices from "choices.js";

const SelectMulti = (): void => {
  // Pass single element
  const multiSelects: NodeListOf<HTMLSelectElement> =
    document.querySelectorAll("select[multiple]");

  for (let i = 0; i < multiSelects.length; i++) {
    const multiSelect = multiSelects[i];

    new Choices(multiSelect, {
      allowHTML: false,
      maxItemCount: parseInt(multiSelect.dataset.maxItemCount || "-1"),
      loadingText: multiSelect.dataset.loadingText,
      itemSelectText: multiSelect.dataset.selectText,
      maxItemText: multiSelect.dataset.maxItemText,
      noChoicesText: multiSelect.dataset.noChoicesText,
      noResultsText: multiSelect.dataset.noResultsText,
      removeItemButton: true,
      classNames: {
        containerOuter: "choices",
        containerInner: "choices__inner",
        input: "choices__input",
        inputCloned: "choices__input--cloned",
        list: "choices__list",
        listItems: "choices__list--multiple",
        listSingle: "choices__list--single",
        listDropdown: "choices__list--dropdown",
        item: "choices__item",
        itemSelectable: "choices__item--selectable",
        itemDisabled: "choices__item--disabled",
        itemChoice: "choices__item--choice",
        placeholder: "choices__placeholder",
        group: "choices__group",
        groupHeading: "choices__heading",
        button: "choices__button",
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

export default SelectMulti;
