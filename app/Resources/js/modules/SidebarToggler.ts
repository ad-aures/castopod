const SidebarToggler = (): void => {
  const sidebar = document.querySelector(
    "aside[data-sidebar-toggler='sidebar']"
  ) as HTMLElement;
  const toggler = document.querySelector(
    "button[data-sidebar-toggler='toggler']"
  ) as HTMLButtonElement;
  const sidebarBackdrop = document.querySelector(
    "div[data-sidebar-toggler='backdrop']"
  ) as HTMLDivElement;

  if (typeof sidebar.dataset.toggleClass !== "undefined") {
    console.log("zefzef");

    const setAriaExpanded = (isExpanded: "true" | "false") => {
      toggler.setAttribute("aria-expanded", isExpanded);
      sidebarBackdrop.setAttribute("aria-expanded", isExpanded);
    };

    const hideSidebar = () => {
      setAriaExpanded("false");
      sidebar.classList.add(sidebar.dataset.toggleClass as string);
      sidebarBackdrop.classList.add("hidden");
      toggler.classList.add(toggler.dataset.toggleClass as string);
    };

    const showSidebar = () => {
      setAriaExpanded("true");
      sidebar.classList.remove(sidebar.dataset.toggleClass as string);
      sidebarBackdrop.classList.remove("hidden");
      toggler.classList.remove(toggler.dataset.toggleClass as string);
    };

    toggler.addEventListener("click", () => {
      if (sidebar.classList.contains(sidebar.dataset.hideClass as string)) {
        showSidebar();
      } else {
        hideSidebar();
      }
    });

    sidebarBackdrop.addEventListener("click", () => {
      if (!sidebar.classList.contains(sidebar.dataset.hideClass as string)) {
        hideSidebar();
      }
    });

    const setAriaExpandedOnWindowEvent = () => {
      const isExpanded =
        !sidebar.classList.contains(sidebar.dataset.hideClass as string) ||
        window.innerWidth >= 768;
      const ariaExpanded = toggler.getAttribute("aria-expanded");
      if (isExpanded && (!ariaExpanded || ariaExpanded === "false")) {
        setAriaExpanded("true");
      } else if (!isExpanded && (!ariaExpanded || ariaExpanded === "true")) {
        setAriaExpanded("false");
      }
    };

    window.addEventListener("load", setAriaExpandedOnWindowEvent);
    window.addEventListener("resize", setAriaExpandedOnWindowEvent);
  }
};

export default SidebarToggler;
