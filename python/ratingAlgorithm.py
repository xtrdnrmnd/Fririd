SMAX = 10
VMAX = 10
BMAX = 10
PMAX = 10


def count(S, V, B, P):
    R = S * 5 / SMAX + V * 2 / VMAX + B * 2 / BMAX + P / PMAX
    return R
