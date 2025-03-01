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
        activeState: "is-active",
        addChoice: ["choices__item--selectable", "add-choice"],
        button: "choices__button",
        containerInner: "choices__inner",
        containerOuter: "choices",
        description: "choices__description",
        disabledState: "is-disabled",
        flippedState: "is-flipped",
        focusState: "is-focused",
        group: "choices__group",
        groupHeading: "choices__heading",
        highlightedState: "is-highlighted",
        input: "choices__input",
        inputCloned: "choices__input--cloned",
        item: "choices__item",
        itemChoice: "choices__item--choice",
        itemDisabled: "choices__item--disabled",
        itemSelectable: "choices__item--selectable",
        list: "choices__list",
        listDropdown: "choices__list--dropdown",
        listItems: "choices__list--multiple",
        listSingle: "choices__list--single",
        loadingState: "is-loading",
        noChoices: "has-no-choices",
        noResults: "has-no-results",
        notice: "choices__notice",
        openState: "is-open",
        placeholder: "choices__placeholder",
        selectedState: "is-selected",
      },
    });
  }
};

export default SelectMulti;
