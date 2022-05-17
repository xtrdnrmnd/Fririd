def __init__(self, stack_list=None):
    self.stack_list = stack_list or []


def save(self, file_path):

    data = dict(stack_list=self.stack_list)
    with open(file_path, "w") as f:
        json.dump(data, f)


def load(self, file_path):

    with open(file_path, "r") as f:
        data = json.load(f)

    # for backward compatibility
    if isinstance(data, list):
        self.stack_list = data
        return

    self.stack_list = data["stack_list"]


@classmethod
def _fetch_html(cls, url, request_args=None):
    request_args = request_args or {}
    headers = dict(cls.request_headers)
    if url:
        headers["Host"] = urlparse(url).netloc

    user_headers = request_args.pop("headers", {})
    headers.update(user_headers)
    res = requests.get(url, headers=headers, **request_args)
    if res.encoding == "ISO-8859-1" and not "ISO-8859-1" in res.headers.get(
        "Content-Type", ""
    ):
        res.encoding = res.apparent_encoding
    html = res.text
    return html


@classmethod
def _get_soup(cls, url=None, html=None, request_args=None):
    if html:
        html = normalize(unescape(html))
        return BeautifulSoup(html, "lxml")

    html = cls._fetch_html(url, request_args)
    html = normalize(unescape(html))

    return BeautifulSoup(html, "lxml")


@staticmethod
def _get_valid_attrs(item):
    key_attrs = {"class", "style"}
    attrs = {
        k: v if v != [] else "" for k, v in item.attrs.items() if k in key_attrs
    }

    for attr in key_attrs:
        if attr not in attrs:
            attrs[attr] = ""
    return attrs


@staticmethod
def _child_has_text(child, text, url, text_fuzz_ratio):
    child_text = child.getText().strip()

    if text_match(text, child_text, text_fuzz_ratio):
        parent_text = child.parent.getText().strip()
        if child_text == parent_text and child.parent.parent:
            return False

        child.wanted_attr = None
        return True

    if text_match(text, get_non_rec_text(child), text_fuzz_ratio):
        child.is_non_rec_text = True
        child.wanted_attr = None
        return True

    for key, value in child.attrs.items():
        if not isinstance(value, str):
            continue

        value = value.strip()
        if text_match(text, value, text_fuzz_ratio):
            child.wanted_attr = key
            return True

        if key in {"href", "src"}:
            full_url = urljoin(url, value)
            if text_match(text, full_url, text_fuzz_ratio):
                child.wanted_attr = key
                child.is_full_url = True
                return True

    return False
