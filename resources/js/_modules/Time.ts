const Time = (): void => {
  const timeElements: NodeListOf<HTMLTimeElement> =
    document.querySelectorAll("time");

  for (let i = 0; i < timeElements.length; i++) {
    const timeElement = timeElements[i];

    // convert UTC date value to user timezone
    const timeElementDateTime = timeElement.getAttribute("datetime");

    // check if timeElementDateTime is not null and not a duration
    if (timeElementDateTime && !timeElementDateTime.startsWith("PT")) {
      const dateTime = new Date(timeElementDateTime);

      // replace <time/> title with localized datetime
      timeElement.setAttribute("title", dateTime.toLocaleString());
    }
  }
};

export default Time;
