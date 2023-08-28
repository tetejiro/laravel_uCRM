const nl2br = (attribute) => {
    return attribute.replace("\n", '<br>');
}

const getDate = () => {
    let dates = new Date();
    let year = dates.getFullYear();
    let month = '0' + (dates.getMonth() + 1);
    month = month.slice(-2);
    let day = '0' + dates.getDate();
    day = day.slice(-2);

    return year + "-" + month + "-" + day;
}


export { nl2br, getDate }