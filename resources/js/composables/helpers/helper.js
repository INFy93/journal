import dayjs from 'dayjs';
import localizedFormat from 'dayjs/plugin/localizedFormat';
import ru from 'dayjs/locale/ru';
export default function useHelpers() {
    dayjs.locale(ru);
    dayjs.extend(localizedFormat)

    function formatDate(date, format="DD/MM/YYYY")
    {
        return dayjs(date).format(format)
    }

    return {
        formatDate
    }


}
