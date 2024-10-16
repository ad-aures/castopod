import Choices from "choices.js";

const Select = (): void => {
  // Pass single element
  const selects: NodeListOf<HTMLSelectElement> = document.querySelectorAll(
    "select:not([multiple])"
  );

  for (let i = 0; i < selects.length; i++) {
    const select = selects[i];

    new Choices(select, {
      allowHTML: false,
      loadingText: select.dataset.loadingText,
      itemSelectText: select.dataset.selectText,
      maxItemText: select.dataset.maxItemText,
      noChoicesText: select.dataset.noChoicesText,
      noResultsText: select.dataset.noResultsText,
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

export default Select;
