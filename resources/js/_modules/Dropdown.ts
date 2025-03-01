import {
  computePosition,
  flip,
  offset,
  Placement,
  shift,
} from "@floating-ui/dom";

const Dropdown = (): void => {
  const dropdownButtons: NodeListOf<HTMLButtonElement> =
    document.querySelectorAll("[data-dropdown='button']");

  for (let i = 0; i < dropdownButtons.length; i++) {
    const button = dropdownButtons[i];

    if (button.dataset.dropdownTarget) {
      const menu: HTMLElement | null = document.getElementById(
        button.dataset?.dropdownTarget
      );

      if (menu) {
        // place the menu at then end of the body to prevent any overflow cuts
        document.body.appendChild(menu);

        const update = () => {
          const offsetX = menu.dataset.dropdownOffsetX
            ? parseInt(menu.dataset.dropdownOffsetX)
            : 0;
          const offsetY = menu.dataset.dropdownOffsetY
            ? parseInt(menu.dataset.dropdownOffsetY)
            : 0;
          computePosition(button, menu, {
            placement: menu.dataset.dropdownPlacement as Placement,
            middleware: [
              offset({ mainAxis: offsetY, crossAxis: offsetX }),
              flip(),
              shift(),
            ],
          }).then(({ x, y }) => {
            Object.assign(menu.style, {
              left: `${x}px`,
              top: `${y}px`,
            });
          });
        };

        const showMenu = () => {
          menu.setAttribute("data-show", "");
          button.setAttribute("aria-expanded", "true");
          update();
        };

        const hideMenu = () => {
          menu.removeAttribute("data-show");
          button.setAttribute("aria-expanded", "false");
        };

        const dropdownToggle = () => {
          const isExpanded = menu.hasAttribute("data-show");

          if (isExpanded) {
            hideMenu();
          } else {
            showMenu();
          }
        };

        // Toggle dropdown menu on button click event
        button.addEventListener("click", dropdownToggle);

        // Toggle off when clicking outside of dropdown
        document.addEventListener("click", function (event) {
          const isExpanded = menu.hasAttribute("data-show");
          const isClickOutside =
            !menu.contains(event.target as Node) &&
            !button.contains(event.target as Node);

          if (isExpanded && isClickOutside) {
            dropdownToggle();
          }
        });
      }
    }
  }
};

export default Dropdown;
