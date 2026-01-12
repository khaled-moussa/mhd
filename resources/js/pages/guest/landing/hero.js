import { CountUp } from "countup.js";
import { Odometer } from "odometer_countup";

export default function initCountUp() {
    const ids = [
        {
            id: "projects-number",
            count: 90,
        },
        {
            id: "customers-number",
            count: 870,
        },
        {
            id: "years-of-experience-number",
            count: 17,
        },
    ];

    ids.forEach((element) => {
        const countUp = new CountUp(element.id, element.count, {
            enableScrollSpy: false,
            plugin: new Odometer({ duration: 1, lastDigitDelay: 0 }),
            duration: 1.0,
        });

        if (!countUp.error) {
            countUp.start();
        } else {
        }
    });
}
