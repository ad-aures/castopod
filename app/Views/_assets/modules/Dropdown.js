import { createPopper } from "@popperjs/core";

const Dropdown = () => {
  const dropdownContainers = document.querySelectorAll(
    "[data-toggle='dropdown']"
  );

  for (let i = 0; i < dropdownContainers.length; i++) {
    const dropdownContainer = dropdownContainers[i];

    const button = dropdownContainer.querySelector("[data-popper='button']");
    const menu = dropdownContainer.querySelector("[data-popper='menu']");

    const popper = createPopper(button, menu, {
      placement: menu.dataset.popperPlacement,
      modifiers: [
        {
          name: "offset",
          options: {
            offset: [menu.dataset.popperOffsetX, menu.dataset.popperOffsetY],
          },
        },
      ],
    });

    const dropdownToggle = () => {
      const isExpanded = !menu.classList.contains("hidden");

      if (isExpanded) {
        menu.classList.add("hidden");
        menu.classList.remove("flex");
      } else {
        menu.classList.add("flex");
        menu.classList.remove("hidden");
      }

      button.setAttribute("aria-expanded", isExpanded);
      popper.update();
    };

    // Toggle dropdown menu on button click event
    button.addEventListener("click", dropdownToggle);

    // Toggle off when clicking outside of dropdown
    document.addEventListener("click", function (event) {
      const isExpanded = !menu.classList.contains("hidden");
      const isClickOutside = !dropdownContainer.contains(event.target);

      if (isExpanded && isClickOutside) {
        dropdownToggle();
      }
    });
  }
};

export default Dropdown;
