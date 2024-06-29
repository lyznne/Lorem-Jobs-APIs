/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php"],
    theme: {
        extend: {
            colors : {
                primary: "#F2FEFF",
                secondary: "#BDE7EA",
                tertiary: "#007F62",
                action: "#E37029",
                black : "#051937"
            },
            backgroundImage: {
                "gradient-color":
                    "linear-gradient(to left top, #051937, #001b4f, #001b67, #00177d, #000790)",
            },
        },
    },
    plugins: [],
};
